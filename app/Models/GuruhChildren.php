<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuruhChildren extends Model
{
    protected $fillable = ['guruh_id', 'children_id', 'start_date', 'start_description', 'start_user_id', 'end_date', 'end_description', 'end_user_id', 'status'];

    public function guruh()
    {
        return $this->belongsTo(Guruh::class);
    }

    public function childreen()
    {
        return $this->belongsTo(Childreen::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
