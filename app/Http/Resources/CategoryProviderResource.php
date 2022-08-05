<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Customer */
class CategoryProviderResource extends JsonResource
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
            'name' => $this->name,
            'stauts' => (int) $this->stauts,
            'description' => $this->description,
            'image' => $this->getFirstMediaUrl() ?: null,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}