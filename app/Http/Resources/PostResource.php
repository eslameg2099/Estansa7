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
            'slug' =>  $this->slug,
            'stauts' => (int) $this->stauts,
            'description' => $this->description,
            'views' => (int) $this->view ,
            'auther'  => $this->user->name,
            'auther_image'  => $this->user->getAvatar(),
            'auther_id'  => $this->user->id,
            'category'  => $this->category->name,
            'category_id'  => $this->category->name,
            'image' => $this->getFirstMediaUrl() ?: null,
            'is_favorite' => $this->checkfavorited(auth('sanctum')->id()),
            'created_at' => new Date($this->created_at),
        ];
    }
}