<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrdersHasProducts extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'quantity',
        'unit_price',
        'unit_price_vat',
        'order_id',
        'product_id',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'orders_has_products');
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'orders_has_products');
    }
}
