<?php


namespace App\Traits;


use App\Notifications\Channels\PusherChannel;
use App\Models\User;
use App\Models\SmsLog;
use App\Notifications\CustomNotification;
use Illuminate\Support\Facades\Notification;
use Laraeast\LaravelSettings\Facades\Settings;
use App\Models\Notification as NotificationModel;


trait NotificationsHandlerTrait
{

    private $request;
    private $users;

    public function checkAndSendNotification($request) {
        $this->request = $request;
        $this->getTypeAndUsers();
        return true;
    }

    private function getTypeAndUsers() {
        if ($this->request->has('user_id')) { $this->sendToUser(); }
        else if ($this->request->user_type == User::CUSTOMER_TYPE)    { $this->sendToAllUsers(User::CUSTOMER_TYPE); }
        else if ($this->request->user_type == User::CHEF_TYPE    )    { $this->sendToAllChefs(User::CHEF_TYPE); }
        else if (is_null($this->request->user_type))    { $this->sendToAll(); }

        else { throw new \Exception(trans('global.must_select_senders')); }

        $this->sendByType();
    }

    private function sendToUser() {
        $this->users   =  User::query()
            ->where('id', $this->request->input('user_id'))
            ->select('id', 'phone', 'city_id')
            ->firstOrFail();
    }
    private function sendToChefs() {
        $this->users   =  User::query()
            ->Where('id', $this->request->input('delegate_id'))
            ->select('id', 'phone', 'city_id')
            ->firstOrFail();
    }

    private function sendToAllUsers($type) {
        $this->users    =   User::query()->where('type', $type)->select('id', 'phone')->get();
    }
    private function sendToAllChefs($type) {
        $this->users    =   User::query()->where('type', $type)->select('id', 'phone')->get();
    }

    private function sendToAll() {
        $this->users  =    User::query()->select('id', 'phone')->get();
    }

    private function sendByType() {
        $this->users = method_exists($this->users, 'unique') ? $this->users->unique('id') : collect([$this->users]);
        $this->sendNotification();
        //switch ($this->request->input('notification_type')) {
        //    case 1:
        //        $this->sendNotification();
        //        break;
        //    case 2:
        //        $this->sendSMS();
        //        break;
        //    default:
        //        throw new \Exception(trans('global.must_select_notification_type'));
        //}
    }

    private function sendNotification() {
       // return $this->users;
        $this->request->offsetSet('title', 'اشعار من الادارة');
        foreach ($this->users as $user){
            Notification::send($user, new CustomNotification([
                'via' => ['database', PusherChannel::class],
                'database' => [
                    'trans' => 'notifications.admin_notification',
                    'user_id' => $user->id,
                    'type' => NotificationModel::ADMIN_TYPE,
                    'id' => $user->id,
                ],
                'fcm' => [
                    'title' => $this->request->input('title'),
                    'body' => $this->request->input('body'),
                    'type' => NotificationModel::ADMIN_TYPE,
                    'data' => [
                        'id' => $user->id,
                    ],
                ],
            ]));
        }

    }

    private function sendSMS() {
        $mobiles = $this->users->implode('mobile', ',');
        $this->sendBulkMessage($this->users, SmsLog::AdminNotification, $mobiles);
    }

}
