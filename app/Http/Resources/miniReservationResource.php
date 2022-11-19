<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Date;
use App\Support\Price;
use PhpParser\Node\Expr\Cast\Double;
use Illuminate\Support\Carbon;

/** @mixin \App\Models\Customer */
class miniReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @throws \Laracasts\Presenter\Exceptions\PresenterException
     * @return array
     */
    public function toArray($request)
    {
        return [
            'day_at' => $this->day_at,
       
        ];
    }
}