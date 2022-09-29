<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Date;
use App\Support\Price;

/** @mixin \App\Models\Customer */
class TransactionResource extends JsonResource
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
            'model' => $this->model,
            'model_id' =>  $this->model_id,
            'type' =>  $this->type,
            'amount' =>new price($this->amount),
            'created_at' => new Date($this->created_at),

        ];
    }
}