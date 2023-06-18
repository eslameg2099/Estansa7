<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Date;
use App\Support\Price;
use PhpParser\Node\Expr\Cast\Double;
use Illuminate\Support\Carbon;

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
            'payment_id' => $this->payment_id,
            'provider' => new miniproviderResource($this->provider),
            'customer' => new minicustomerResource($this->customer),

            'category' => $this->category->name ?? '_',
            'stauts' =>(int) $this->stauts,
            'from' => Carbon::parse($this->from)->format('h:i A'),
            'to' => Carbon::parse($this->to)->format('h:i A'),
            'from_formatted' => Carbon::parse($this->from)->format('h:i:s'),
            'to_formatted' => Carbon::parse($this->to)->format('h:i:s'),
            'time' => "20 دقيقة",
            'cost_before_discount' => new price($this->cost),

            'cost' => new price($this->cost - $this->discount),

            'cost_provider'=> new price(($this->cost*80)/100),
            'day_at' => new Date($this->day_at),
            'comment' => $this->comment,
            'url'=>"https://meet.jit.si/estansa7/".$this->id,
            'active_url'=>$this->checklink(),
            'discount'=> new price($this->discount),
            'created_at' => new Date( $this->created_at),
            'free'=>true,
            'wait_time' => Carbon::parse($this->from)->format('h:i') - Carbon::parse(today())->format('h:i'),


        ];
    }
}