<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Date;
use App\Support\Price;
/** @mixin \App\Models\Customer */
class ReservationResource extends JsonResource
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
            'id' => $this->id,
            'provider' => new miniproviderResource($this->provider),
            'category' => $this->category->name ?? '_',
            'stauts' =>(int) $this->stauts,
            'from' =>  $this->from,
            'to' => $this->to,
            'cost' => new price($this->cost),
            'day_at' => new Date( $this->day_at),
            'comment' => $this->comment,
            'url'=>"https://meet.jit.si/estansa7/".$this->id,
            'created_at' => new Date( $this->created_at),

        ];
    }
}