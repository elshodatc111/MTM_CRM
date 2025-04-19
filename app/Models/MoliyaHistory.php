<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoliyaHistory extends Model{
    protected $fillable = [
        'amount',
        'type',
        'status',
        'start_meneger_id',
        'start_description',
        'end_meneger_id',
    ];

    public function startManager()
    {
        return $this->belongsTo(User::class, 'start_meneger_id');
    }

    public function endManager()
    {
        return $this->belongsTo(User::class, 'end_meneger_id');
    }
}
