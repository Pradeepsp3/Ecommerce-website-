<?php

namespace App\Models;

use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    // public function orders()
    // {
    //     return $this->hasManyThrough(Item::class, Order::class);
    // }

    public function items(){
        return $this->hasMany(Item::class);
    }
}
