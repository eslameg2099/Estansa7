<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Date;
use App\Support\Price;

/** @mixin \App\Models\Customer */
class providerResource extends JsonResource
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
            'email' => $this->email,
            'phone' => $this->phone,
            'type' => $this->type,
            'avatar' => $this->getAvatar(),
            'address'=> $this->address,
            'bio'=> $this->bio,
            'linkedin'=> $this->linkedin,
            'category_name'=> $this->category->name,
            'certificates'=> MediaResource::collection($this->getMedia()),
            'cv'=> $this->getFirstMediaUrl("cv"),
            'unit_price'=>new price($this->unit_price),
            'skills'=> $this->skills,
            'experience'=>$this->experience,
            'localed_type' => $this->present()->type,
            'created_at' => new Date($this->created_at),
        ];
    }
}
