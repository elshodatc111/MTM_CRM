<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuruhTecher extends Model
{
    protected $fillable = [
        'guruh_id', 'user_id',
        'start_date', 'start_description', 'start_meneger_id',
        'end_date', 'end_description', 'end_meneger_id',
        'status'
    ];

    public function guruh()
    {
        return $this->belongsTo(Guruh::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
