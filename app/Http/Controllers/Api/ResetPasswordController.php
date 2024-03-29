<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\ResetPasswordCode;
use Illuminate\Auth\Events\Login;
use App\Models\ResetPasswordToken;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Requests\Api\ResetPasswordRequest;
use App\Http\Requests\Api\ForgetPasswordRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Notifications\Accounts\PasswordUpdatedNotification;
use App\Http\Requests\Api\ResetPasswordCodeRequest;
use App\Notifications\Accounts\SendForgetPasswordCodeNotification;
use Illuminate\Support\Facades\Http;
use App\Traits\mail;

class ResetPasswordController extends Controller
{
    use AuthorizesRequests, ValidatesRequests,mail;

    /**
     * Send the forget password code to the user.
     *
     * @param \App\Http\Requests\Api\ForgetPasswordRequest $request
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Http\JsonResponse
     */
    public function forget(ForgetPasswordRequest $request)
    {
        $user = User::where(function (Builder $query) use ($request) {
            $query->where('email', $request->username);
           
        })->first();

        if (! $user) {
            throw ValidationException::withMessages([
                'username' => [trans('auth.failed')],
            ]);
        }

        $resetPasswordCode = ResetPasswordCode::updateOrCreate([
            'username' => $request->username,
            'user_id'=>$user->id,
        ], [
            'username' => $request->username,
            'code' => rand(111111, 999999),
            'user_id'=>$user->id,

        ]);

        $this->sendmail($user->name,$resetPasswordCode->code,$user->email,'rest','اعادة تعين كلمة المرور',$user->created_at,$user->created_at);
        return response()->json([
            'message' => trans('auth.messages.forget-password-code-sent'),
            'links' => [
                'code' => [
                    'href' => route('api.password.code'),
                    'method' => 'POST',
                ],
            ],
        ]);
    }

    /**
     * Get the reset password token using verification code.
     *
     * @param \App\Http\Requests\Api\ResetPasswordCodeRequest $request
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Http\JsonResponse
     */
    public function code(ResetPasswordCodeRequest $request)
    {
        $resetPasswordCode = ResetPasswordCode::where('username', $request->username)
            ->where('code', $request->code)
            ->first();

        $user = User::where(function (Builder $query) use ($request) {
            $query->where('email', $request->username);
            $query->orWhere('phone', $request->username);
        })->first();

        if (! $resetPasswordCode || $resetPasswordCode->isExpired() || ! $user) {
            throw ValidationException::withMessages([
                'code' => [
                    trans('validation.exists', [
                        'attribute' => trans('auth.attributes.code'),
                    ]),
                ],
            ]);
        }

        $resetPasswordCode->delete();

        ResetPasswordToken::forceCreate([
            'user_id' => $user->id,
            'token' => $token = Str::random(80),
        ]);

        return response()->json([
            'reset_token' => $token,
            'links' => [
                'reset' => [
                    'href' => route('api.password.reset'),
                    'method' => 'POST',
                ],
            ],
        ]);
    }

    public function reset(ResetPasswordRequest $request)
    {
        $resetPasswordToken = ResetPasswordCode::where('code',$request->only('token'))->first();

        if (! $resetPasswordToken || $resetPasswordToken->isExpired()) {
            throw ValidationException::withMessages([
                'token' => [
                    trans('validation.exists', [
                        'attribute' => trans('auth.attributes.token'),
                    ]),
                ],
            ]);
        }

        $user = $resetPasswordToken->user;

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        try {
            $user->notify(new PasswordUpdatedNotification());
        } catch (\Exception $exception) {
        }

        event(new Login('sanctum', $user, false));

        $resetPasswordToken->delete();

        return $user->getResource()->additional([
            'token' => $user->createTokenForDevice(
                $request->header('user-agent')
            ),
        ]);
    }
}
