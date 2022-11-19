<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Filters\ReservationFilter;
use App\Http\Filters\Filterable;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;
    use SoftDeletes; 
    use Filterable;

  
    protected $filter = ReservationFilter::class;




    protected $fillable = [
        'id',
        'address_id',
        'user_id',
        'sub_total',
        'stauts',
        'shipping_cost',
        'payment_method',
        'url_host',
        'url_going',
        'meeting_id',
        'provider_id',
        'from',
        'to',
        'comment',
        'category_id',
        'day_at' ,
        'cost' ,
        'payment_id',
        'availabletime_id',

    ];

    public function availabletime()
   {
     return $this->belongsTo(AvailableTime::class, 'availabletime_id');
   }

    public function provider()
    {
     return $this->belongsTo(User::class, 'provider_id');
    }

    public function customer()
    {
     return $this->belongsTo(Customer::class, 'user_id');
    }

    public function category()
    {
     return $this->belongsTo(CategoryProvider::class,'category_id');
    }


    public function scopeauth()
    {
        switch(auth()->user()->type) {
            case('provider'):
 
            return Reservation::where('provider_id',auth()->user()->id);
                break;
 
            case('customer'):
                 
            return Reservation::where('user_id',auth()->user()->id);
                break;
        }
    }


    public function checklink()
    {
        if($this->day_at == Carbon::now()->format('Y-m-d'))
        {
            return true;
        }
        else
        return false;
    }
    


    
}
