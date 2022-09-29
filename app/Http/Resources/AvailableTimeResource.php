<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Date;
use Carbon\Carbon;

/** @mixin \App\Models\Customer */
class AvailableTimeResource extends JsonResource
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
            'day_id' => $this->day_id,
            'from' =>  $this->from,
            'to' => $this->to,
            'active' => (int) $this->active,
            'booked_up' => (int) $this->booked_up,
        ];
    }
}