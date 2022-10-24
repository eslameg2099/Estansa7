<?php

namespace App\Models\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use App\Models\Reservation;
use App\Models\Transaction;
              
class PaymobHelpers
{

   public static function payment($iframe,$user,$model)
   {
       
    $response = Http::withHeaders(['content-type' => 'application/json'])->post('https://accept.paymobsolutions.com/api/auth/tokens',
    ["api_key" => 'ZXlKMGVYQWlPaUpLVjFRaUxDSmhiR2NpT2lKSVV6VXhNaUo5LmV5SndjbTltYVd4bFgzQnJJam8xTURjMU56WXNJbTVoYldVaU9pSnBibWwwYVdGc0lpd2lZMnhoYzNNaU9pSk5aWEpqYUdGdWRDSjkuUG5EUWJzLTBXYm1Xd0VQTFlkNWV1b2g1a0EyZUk2R0drR01XbmNUdzQyMEFuLVU0QkwyVzFaU2MxX01fQzVWU3d3TnBFYVJreENlbzdISktLSUt5NUE=']);
   $json = $response->json();

   $response_final = Http::withHeaders(['content-type' => 'application/json'])->post('https://accept.paymobsolutions.com/api/ecommerce/orders',
    ["auth_token" => $json['token'],
     "delivery_needed" => "false",
      "amount_cents" =>  $model->cost * 100,
       "items" => []]);
   $json_final = $response_final->json();

   $model->payment_id = $json_final['id'];
   $model->save();

   $response_final_final = Http::withHeaders(['content-type' => 'application/json'])->post('https://accept.paymobsolutions.com/api/acceptance/payment_keys', ["auth_token" => $json['token'], "expiration" => 36000, "amount_cents" => $json_final['amount_cents'], "order_id" => $json_final['id'], "billing_data" => ["apartment" => "NA", "email" => 'eslam@yahoo.com', "floor" => "NA",
    "first_name" => $user->name
       , "street" => "NA",
        "building" => "NA",
         "phone_number" =>$user->phone,
          "shipping_method" => "NA",
           "postal_code" => "NA", 
           "city" => "NA", 
           "country" => "NA",
            "last_name" => $user->name
       , "state" => "NA"], "currency" => "EGP",  "integration_id"=>2785803
    ]);

   $response_final_final_json = $response_final_final->json();
   $res = "https://accept.paymobsolutions.com/api/acceptance/iframes/" . $iframe . "?payment_token=" . $response_final_final_json['token'];
   return $res;

   }


   public static function transactions_reservation($model)
   {
           //save many to admin , provider 
           $Transaction_admin = Transaction::create([
            'user_id'=> 1,
            'type'=>'1',
            'amount'=> ($model->cost * 20) /100 ,
            'model'=>'reservation',
            'model_id'=>$model->id,
         ]);
        $user = User::findorfail(1);
        $user->update(['wallet'=> $user->wallet += $Transaction_admin->amount]); 

         $Transaction_cutomer= Transaction::create([
           'user_id'=> $model->user_id,
           'type'=>'0',
           'amount'=> $model->cost ,
           'model'=>'reservation',
           'model_id'=>$model->id,
        ]);
        $user = User::findorfail($model->user_id);
        $user->update(['wallet'=> $user->wallet += $Transaction_admin->amount]); 

        $Transaction_provider = Transaction::create([
           'user_id'=> $model->provider_id,
           'type'=>'1',
           'amount'=> ($model->cost * 80) /100 ,
           'model'=>'reservation',
           'model_id'=>$model->id,
        ]);
        $user = User::findorfail($model->provider_id);
        $user->update(['wallet'=> $user->wallet += $Transaction_admin->amount]);
         
   }

   public static function transactions_course($model)
   {
           //save many to admin , provider 
           $Transaction_admin = Transaction::create([
            'user_id'=> 1,
            'type'=>'1',
            'amount'=> $model->cost ,
            'model'=>'course',
            'model_id'=>$model->id,
         ]);
         $Transaction_cutomer= Transaction::create([
           'user_id'=> $model->user_id,
           'type'=>'0',
           'amount'=> $model->cost ,
           'model'=>'course',
           'model_id'=>$model->id,
        ]);
   
   }

  

  
    

}   