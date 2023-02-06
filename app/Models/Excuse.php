<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Excuse extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'provider_id',
        'type',
        'reservation_id',
        'reason',
        'comment',

    ];
    

}
