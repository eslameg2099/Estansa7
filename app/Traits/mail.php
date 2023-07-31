<?php


namespace App\Traits;
use Illuminate\Support\Facades\Http;

trait mail
{
   
    public function sendmail($user,$code,$email,$type,$title)
    {
        $response = Http::post('https://ulfa.d.deli.work/api/sendmail', $data = [
            'user' => $user,
            'code'=> $code,
            'email'=>$email,
            'type'=>$type,
            'title'=>$title,
        ]); 
   
        
    }
   
   
}
