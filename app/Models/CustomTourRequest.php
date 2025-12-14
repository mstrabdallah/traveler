<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomTourRequest extends Model
{
    protected $guarded = [];

    protected $casts = [
        'destinations' => 'array',
        'arrival_date' => 'date',
        'departure_date' => 'date',
    ];
}
