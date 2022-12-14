<?php

namespace App\Http\Controllers\Api;

use App\Models\Verification;
use Illuminate\Http\Request;
use App\Events\VerificationCreated;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Validation\ValidatesRequests;

class VerificationController extends Controller
{
    use ValidatesRequests;

 
    /**
     * Send or resend the verification code.
     *
     * @param \Illuminate\Http\Request $request
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Request $request)
    {
        $this->validate($request, [
            'phone' => ['required', 'unique:users,phone,'.auth()->id()],
        ], [], trans('verification.attributes'));

       $user = auth()->user();

        $verification = Verification::updateOrCreate([
            'user_id' => $user->id,
        ], [
            'phone' => $request->phone,
            'code' => rand(111111, 999999),
        ]);

        event(new VerificationCreated($verification));

        return response()->json([
            'message' => trans('verification.sent'),
        ]);
    }

    /**
     * Verify the user's phone number.
     *
     * @param \Illuminate\Http\Request $request
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function verify($code)
    {
        $verification = Verification::where('code',$code)->first();
        if (! $verification || $verification->isExpired()) {
            return response()->json([
                'message' => "code is Expired ",
            ]);
        }

        $verification->user->forceFill([
            'phone_verified_at' => now(),
        ])->save();
       
        $verification->delete();
        return redirect('https://estansa7.com/');
        

     }

    /**
     * Check if the password of the authenticated user is correct.
     *
     * @param \Illuminate\Http\Request $request
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function password(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ], [], trans('auth.attributes'));

        if (! Hash::check($request->password, $request->user()->password)) {
            throw ValidationException::withMessages([
                'password' => [trans('auth.password')],
            ]);
        }

        return $request->user()->getResource();
    }


    public function newverify($code)
    {
        return $code;

       
        $verification = Verification::where([
            'code' => $code,
        ])->firstOrFail();

        if (! $verification || $verification->isExpired()) {
            throw ValidationException::withMessages([
                'code' => [trans('verification.invalid')],
            ]);
        }

        $verification->user->forceFill([
            'phone' => $verification->phone,
            'phone_verified_at' => now(),
        ])->save();

        $verification->delete();

        return $verification->user->getResource();
    }

}
