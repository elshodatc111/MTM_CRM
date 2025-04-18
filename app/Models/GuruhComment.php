<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuruhComment extends Model{
    protected $fillable = ['guruh_id', 'comment', 'user_id'];

    public function guruh(){
        return $this->belongsTo(Guruh::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
