<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Date;

/** @mixin \App\Models\Customer */
class ReviewResource extends JsonResource
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
            'user' => $this->user->name,
            'avatar' => $this->user->getAvatar(),
            'rate' =>  $this->rate,
            'comment' => $this->comment,
            'created_at' => new Date($this->created_at),

        ];
    }
}