<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if($request->isMethod('post')){
        return [
            "item_name" => "required",
            "product_id" => "required",
            "category_id" => "required",
            "image" => "required|image",
            "description" => "required",
            "price" => "required",
            "quantity" => "required",
        ];
        } else {
            return [
                "item_name" => "required",
                "product_id" => "required",
                "category_id" => "required",
                "image" => "nullable|image",
                "description" => "required",
                "price" => "required",
                "quantity" => "required",
            ];

        }
    }

    public function message(){

        if($request->isMethod('post')){

        return [
            'item_name.required' => "Item Name is required",
            'product_id.required' => "Product Id is required",
            'category_id.required' => "Category Id is required",
            'image.required' => "Image is required",
            'description.required' => "Description is required",
            'price.required' => "Price is required",
            'quantity.required' => "Quantity is required",
        ];
    } else {
        return [
            'item_name.required' => "Item Name is required",
            'product_id.required' => "Product Id is required",
            'category_id.required' => "Category Id is required",
            'description.required' => "Description is required",
            'price.required' => "Price is required",
            'quantity.required' => "Quantity is required",
        ];
    }
    }
}
