<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductsHasCategories extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'category_id',
        'product_id',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'products_has_categories');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'products_has_categories');
    }
}
