<?php

namespace App\Models;
use App\Http\Filters\Filterable;
use App\Http\Filters\CouponFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\Traits\Selectable;

class Coupon extends Model
{
    use HasFactory;
    use Selectable;
    use Filterable;

    protected $filter = CouponFilter::class;


    /**
     * The query parameter's filter of the model.
     *
     * @var string
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'percentage_value',
        'expired_at',
        'usage_count',
        'usage',
        ''

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'expired_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
  

    /**
     * Determine whither the coupon is expired.
     *
     * @return bool
     */
    public function isExpired()
    {
        return $this->expired_at->isPast();
    }
}
