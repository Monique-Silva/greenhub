<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'price',
        'vat_rate',
        'stock',
        'description',
        'environmental_impact',
        'origin',
        'measuring_unit',
        'measure'
    ];

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'orders_has_products');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'products_has_categories');
    }
}
