<?php

namespace App\Traits;

use App\Http\Resources\UserResource;
use App\Model\SMSMessage;
use App\Models\MasterData\SmsLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

trait HISMS
{

    public function getBalance()
    {
        $username = config('services.hisms.username');
        $password = config('services.hisms.password');

        $response = Http::get('https://www.hisms.ws/api.php', [
            'get_balance' => '',
            'username' => $username,
            'password' => $password,
        ]);
        try {
            return explode(':', $response->body())[1];
        } catch (\Exception $e) {
            return $this->status($response->body());
        }
    }

    public function sendVerificationCode(
        $user,
        $message = 'global.verify_account',
        $type = SmsLog::VerifyCode,
        $customNumber = null
    ) {
        $code = random_int(111111, 999999);

        SmsLog::query()->create([
            'user_id' => $user->id,
            'type' => $type,
            'message' => trans($message, ['code' => $code]),
            'code' => $code,
        ]);

        if ($this->isTestMode()) {
            return '3-232323-local';
        }

        $sender = config('services.hisms.sender');
        $username = config('services.hisms.username');
        $password = config('services.hisms.password');

        $response = Http::get('https://www.hisms.ws/api.php', $data = [
            'send_sms' => '',
            'username' => $username,
            'password' => $password,
            'numbers' => $customNumber ?: $user->number_with_code,
            'sender' => $sender,
            'message' => trans('global.verify_account', ['code' => $code]),
        ]);

        try {
            return $response->body();
        } catch (\Exception $e) {
            return $this->status($response->body());
        }
    }

    public function resendVerificationCode(Request $request, $user = null)
    {
        $user = $user ?: $request->user();

        if (! is_null($user->mobile_verified_at)) {
            return $this->error([
                'message' => trans('errors.user_already_verified'),
                'error_type' => 'AlreadyVerified',
            ]);
        }

        $validationCheck = $this->SmsValidation($user, 'VerifyCode', 'lastVerificationCode');
        if ($validationCheck != 'success') {
            return $validationCheck;
        }

        $this->sendVerificationCode($user);

        return $this->success([
            'message' => trans('global.send_sms_success'),
            'user' => new UserResource(\auth()->user()),
        ]);
    }

    public function sendResetPasswordVerificationCode($user)
    {
        $validationCheck = $this->SmsValidation($user, 'ResetPassword', 'lastResetPasswordCode');

        if ($validationCheck != 'success') {
            return $validationCheck;
        }

        $this->sendVerificationCode($user, 'global.reset_password', SmsLog::ResetPassword);

        return response()->json([
            'status' => true,
            'message' => trans('global.send_sms_success'),
        ]);
    }

    public function sendMessage(Request $request, $type)
    {
        SmsLog::query()->create([
            'user_id' => $request->input('user_id'),
            'type' => $type,
            'message' => $request->input('body'),
        ]);

        if ($this->isTestMode()) {
            return '3-232323-local';
        }

        $response = Http::get('https://www.hisms.ws/api.php', [
            'send_sms' => '',
            'username' => $this->username,
            'password' => $this->password,
            'numbers' => $request->input('phone'),
            'sender' => $this->sender,
            'message' => $request->input('body'),
        ]);
        try {
            return $response->body();
        } catch (\Exception $e) {
            return $this->status($response->body());
        }
    }

    private function SmsValidation($user, $smsType, $lastCodeFunction)
    {
        if (! $user) {
            return $this->error(['message' => trans('errors.invalid_user')]);
        }

        $sms = $user->{$lastCodeFunction}();

        $smsType = constant(SmsLog::class.'::'.$smsType);

        if (is_null($sms)) {
            return 'success';
        }

        return 'success';

        //$sec = Carbon::parse($sms->created_at)->diffInRealSeconds(Carbon::now());
        //
        //$verificationCount = $user->sms()->whereDate('created_at', Carbon::today())->where('type', $smsType)->count();
        //
        //$smsCountInDay = config('services.hisms.limit_per_day');
        //
        //if ($verificationCount >= $smsCountInDay) {
        //    return $this->error(
        //        [
        //            'message' => trans('errors.only_5_sms'),
        //            'error_type' => 'FiveSms',
        //        ]);
        //}
        //
        //if ($sec < 120) {
        //    return $this->error([
        //        'status' => false,
        //        'error_type' => 'WaitSomeSecond',
        //        'message' => trans('errors.wait_sec', ['sec' => (120 - $sec > 0 ? 120 - $sec : 0)]),
        //    ]);
        //}
        //
        //return 'success';
    }

    private function isTestMode()
    {
        return false;

        //return env('APP_ENV') == 'local';
    }

    private function status($code)
    {
        $status = [
            1 => 'اسم المستخدم غير صحيح',
            2 => 'كلمة المرور غير صحيحه',
            3 => 'تم الارسال',
            4 => 'لا يوجد اراقام',
            5 => 'لا يوجد رسالة',
            6 => 'سندر خاطئ',
            7 => 'سندر غير مفعل',
            8 => 'الرسالة تحتوي كلمات ممنوعة',
            9 => 'لا يوجد رصيد',
            10 => 'صيغة التاريخ خاطئة',
            11 => 'صيغة الوقت خاطئة',
            404 => 'لم يتم ادخال جميع البرمترات المطلوبة',
            403 => 'تم تجاوز عدد المحاولات المسموحة',
            504 => 'الحساب معطل',
        ];

        return isset($status[$code]) ? $status[$code] : "خطأ غير معروف";
    }
    public function sendBulkMessage($users, $type, $phones) {
        $username = config('services.hisms.username');
        $password = config('services.hisms.password');
        $response = Http::get('https://www.hisms.ws/api.php', [
            'send_sms'  =>  '',
            'username'  => $username,
            'password'  => $password,
            'numbers'   => $phones,
            'sender'    => config('services.hisms.sender'),
            'message'   => \request()->input('body'),
        ]);
        $users->each(function($user) use ($response, $phones, $type) {
            try {
                $body   =   $response->body();
                SmsLog::query()->create([
                    'user_id'   =>  $user->id,
                    'type'      =>  $type,
                    'message'   =>  \request()->input('body'),
                    'response'  =>  "$body"
                ]);
                return $body;
            } catch (\Exception $e) {
                throw new \Exception(trans('global.sms_not_sent', ['code' => $response->body()]));
            }
        });

    }

}
