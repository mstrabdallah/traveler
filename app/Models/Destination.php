<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Destination extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getDisplayNameAttribute()
    {
        return (app()->getLocale() === 'ar' && $this->name_ar) ? $this->name_ar : $this->name;
    }

    public function getDisplayDescriptionAttribute()
    {
        return (app()->getLocale() === 'ar' && $this->description_ar) ? $this->description_ar : $this->description;
    }

    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class);
    }
}
