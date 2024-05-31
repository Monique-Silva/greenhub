<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'number',
        'road',
        'postal_code',
        'city',
        'country',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function companies(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
