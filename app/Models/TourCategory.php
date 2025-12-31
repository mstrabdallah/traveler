<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TourCategory extends Model
{
    protected $fillable = [
        'name',
        'name_ar',
        'slug',
        'description',
        'description_ar',
        'image',
        'is_active',
        'sort_order',
    ];

    public function getDisplayNameAttribute()
    {
        return (app()->getLocale() === 'ar' && $this->name_ar) ? $this->name_ar : $this->name;
    }

    public function getDisplayDescriptionAttribute()
    {
        return (app()->getLocale() === 'ar' && $this->description_ar) ? $this->description_ar : $this->description;
    }

    public function tours(): BelongsToMany
    {
        return $this->belongsToMany(Tour::class, 'tour_category_tour')->withTimestamps();
    }
}
