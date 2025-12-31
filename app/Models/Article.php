<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = [];

    protected $casts = [
        'published_at' => 'date',
        'is_visible' => 'boolean',
    ];

    public function getDisplayTitleAttribute()
    {
        if (app()->getLocale() === 'ar' && $this->title_ar) {
            return $this->title_ar;
        }
        return $this->title;
    }

    public function getDisplayContentAttribute()
    {
        if (app()->getLocale() === 'ar' && $this->content_ar) {
            return $this->content_ar;
        }
        return $this->content;
    }

    public function getDisplayExcerptAttribute()
    {
        if (app()->getLocale() === 'ar' && $this->excerpt_ar) {
            return $this->excerpt_ar;
        }
        return $this->excerpt;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
