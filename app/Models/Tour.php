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
        'has_seasonal_prices' => 'boolean',
        'seasonal_prices' => 'array',
        'extras' => 'array',
    ];

    public function getDisplayNameAttribute()
    {
        if (app()->getLocale() === 'ar' && $this->name_ar) {
            return $this->name_ar;
        }
        return $this->name;
    }

    public function getDisplayDescriptionAttribute()
    {
        if (app()->getLocale() === 'ar' && $this->description_ar) {
            return $this->description_ar;
        }
        return $this->description;
    }

    public function getDisplayAvailabilityAttribute()
    {
        if (app()->getLocale() === 'ar' && $this->availability_ar) {
            return $this->availability_ar;
        }
        return $this->availability;
    }

    public function getDisplayPickupLocationAttribute()
    {
        if (app()->getLocale() === 'ar' && $this->pickup_location_ar) {
            return $this->pickup_location_ar;
        }
        return $this->pickup_location;
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(TourCategory::class, 'tour_category_tour')->withTimestamps();
    }
}
