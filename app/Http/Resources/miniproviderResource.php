<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Date;
use App\Support\Price;

/** @mixin \App\Models\Customer */
class miniproviderResource  extends JsonResource
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
            'last_name'=>$this->last_name,
            'full_name'=> $this->name . " " . $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'type' => $this->type,
            'avatar' => $this->getAvatar(),
            'bio'=> $this->bio,
            'category_name'=> $this->category->name,
            'unit_price'=>new price($this->unit_price),
            'availabletime_count'=>$this->availabletimes->where('active','1')->count(),
            'reservation_count'=> $this->Reservations->count(),
            'experience'=>$this->experienceyears(),
            'rate'=> $this->checkreview() ,
            'is_favorite' => $this->checkfavorited(auth('sanctum')->id()),
            'free_session'=> $this->free_session(),



        ];
    }
}
