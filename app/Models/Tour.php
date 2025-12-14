<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tour extends Model
{
    protected $guarded = [];

    protected $casts = [
        'itinerary' => 'array',
        'images' => 'array',
        'price_tiers' => 'array',
        'included' => 'array',
        'excluded' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'has_price_tiers' => 'boolean',
    ];

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
