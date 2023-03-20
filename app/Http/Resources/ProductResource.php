<?php

namespace App\Http\Resources;

use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "product_name" => $this->product_name,
            // "category" =>  CategoryResource::collection($this->categories)
        ];

    }

    // public function with($request){
    //     return [
    //         "category_name" => CategoryResource::collection($this->categories),
    //     ];
    // }
}
