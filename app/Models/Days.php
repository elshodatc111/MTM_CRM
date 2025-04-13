<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Days extends Model{
    protected $fillable = [
        'days',
        'description',
    ];

    protected $casts = [
        'days' => 'date',
    ];
}
