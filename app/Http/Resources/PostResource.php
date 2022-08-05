<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Date;

/** @mixin \App\Models\Customer */
class PostResource extends JsonResource
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
            'titele' => $this->titele,
            'stauts' => (int) $this->stauts,
            'description' => $this->description,
            'view' => (int) $this->view ,
            'auther'  => $this->user->name,
            'category'  => $this->category->name,
            'image' => $this->getFirstMediaUrl() ?: null,
            'created_at' => new Date($this->created_at),
        ];
    }
}