<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    


     public function toArray()
     {
         return [
            'id' => $this->id,
            'day_id' => $this->day_id,
            'from' => date('h:i a', strtotime($this->from)),
            'to' => date('h:i a', strtotime( $this->to)),
            'active' => (int) $this->active,
            'booked_up' => (int) $this->booked_up,

         ];
     }



}
