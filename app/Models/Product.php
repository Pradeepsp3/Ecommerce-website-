<?php

namespace App\Models;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }
}
