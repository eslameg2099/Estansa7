<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Date;

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
            'day_name' => $this->day_id,
            'from' => (int) $this->from,
            'to' => $this->to,

        ];
    }
}