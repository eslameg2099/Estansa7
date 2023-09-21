<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\Price;

use Carbon\Carbon;

use App\Http\Resources\miniReservationResource;

class AvailableTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'day_id',
        'from',
        'to',
        'user_id',
        'active',
        'booked_up'
    ];

   public function provider()
   {
    return $this->belongsTo(User::class, 'user_id');
   }
    
   public function reservations()
   {
       return $this->hasMany(Reservation::class,'availabletime_id')->where('stauts','2')->where('day_at','>=', Carbon::now())->select('day_at')->get();
   }

     public function toArray()
     {
         return [
            'id' => $this->id,
            'day_id' => $this->day_id,
            'day_name' => $this->getname(),
            'from_show' => date('h:i a', strtotime($this->from)),
            'to_show' => date('h:i a', strtotime( $this->to)),
            'from' => $this->from,
            'to' =>$this->to,
            'active' => (int) $this->active,
            'booked_up' => (int) $this->booked_up,
            'cost' => new price($this->provider->unit_price),
            'reservations'=>  $this->reservations()->pluck('day_at'),

         ];
     }


     public function getname()
     {
         switch($this->day_id) {
             case('0'):
             return "الاحد";
                 break;
             case('1'):
             return "الاثنين";
                 break;
                 case('2'):  
             return "الثلاثاء";
                  break;
                  case('3'):   
             return "الاربعاء";
                  break;
                  case('4'):   
             return "الخميس";
                   break;
                  case('5'):   
             return "الجمعة";
                     break;
                     case('6'):   
            return "السبت";
                     break;
         }
     }


      public function scopeActive($query)
    {
        return $query->where('active','1');
    }


   



}
