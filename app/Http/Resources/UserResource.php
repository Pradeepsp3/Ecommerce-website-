<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => [
                'address' => $this->address,
                'address2' => $this->address2,
                'city' => $this->city,
                'state' => $this->state,
                'country' => $this->country,
                'zipcode' => $this->zipcode,
            ],
            'orders' => OrderResource::collection($this->orders),

        ];
    }
}
