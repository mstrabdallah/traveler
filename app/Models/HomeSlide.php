<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSlide extends Model
{
    protected $fillable = [
        'image',
        'subtitle_en',
        'subtitle_ar',
        'title_en',
        'title_ar',
        'description_en',
        'description_ar',
        'button_text_en',
        'button_text_ar',
        'button_url',
        'is_active',
        'sort_order',
    ];

    public function getSubtitleAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->subtitle_ar : $this->subtitle_en;
    }

    public function getTitleAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->title_ar : $this->title_en;
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->description_ar : $this->description_en;
    }

    public function getButtonTextAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->button_text_ar : $this->button_text_en;
    }
}
