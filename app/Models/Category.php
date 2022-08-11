<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;

    /**
     * Get all the products for the Category
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
