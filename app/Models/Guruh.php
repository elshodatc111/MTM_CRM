<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guruh extends Model
{
    protected $fillable = ['name', 'amount', 'katta_tarbiyachi', 'kichik_tarbiyachi', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function techers()
    {
        return $this->hasMany(GuruhTecher::class);
    }

    public function davomads()
    {
        return $this->hasMany(GuruhDavomad::class);
    }
}
