<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Date;
use App\Support\Price;
use App\Models\Reservation;

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
            'name' => $this->name ." ".$this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'wallet' => new price($this->wallet),
            'reservation_count'=> $this->Reservations->count(),
            'type' => $this->type,
            'avatar' => $this->getAvatar(),
            'address'=> $this->address,
            'bio'=> $this->bio,
            'linkedin'=> $this->linkedin,
            'category_name'=> $this->category->name,
            'categories' => miniCategoryProviderResource::collection($this->categories),
            'certificates'=> MediaResource::collection($this->getMedia('default')),
            'cv'=> $this->getFirstMediaUrl("cv"),
            'unit_price'=>new price($this->unit_price),
            'wallet'=>new price($this->wallet),
            'skills'=> $this->skills,
            'experience'=>$this->experienceyears(),
            'localed_type' => $this->present()->type,
            'is_favorite' => $this->checkfavorited(auth('sanctum')->id()),
            'rate'=> $this->checkreview() ,
            'reviews_count'=> $this->reviews()->count() ,
            'phone_verified_at' => ! ! $this->phone_verified_at,
            'provider_verified_at' => ! ! $this->provider_verified_at,
            'reviews'=> ReviewResource::collection($this->reviews()->limit(6)->get())  ,
            'time_available'=>$this->availabletimes->groupBy('day_id'),
            'posts'=> PostResource::collection($this->posts),
            'created_at' => new Date($this->created_at),
            
        ];
    }
}
