<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'provider_id',
        'rate',
        'comment',
    ];

    public function user()
    {
     return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeauth()
    {
        switch(auth()->user()->type) {
            case('provider'):
 
            return Review::where('provider_id',auth()->user()->id);
                break;
 
            case('customer'):
                 
            return Review::where('user_id',auth()->user()->id);
                break;
        }
    }


}
