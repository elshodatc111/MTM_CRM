<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuruhDavomad extends Model
{
    protected $fillable = ['guruh_id', 'cheldren_id', 'days', 'status', 'user_id'];

    public function guruh()
    {
        return $this->belongsTo(Guruh::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
