<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'description',
        'website'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function companies(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
