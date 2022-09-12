<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'sku',
        'name',
        'description',
        'price',
        'quantity',
        'state',
    ];

    /**
     * Get the category that owns the Product
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
