<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChildrenComment extends Model{
    protected $fillable = ['children_id', 'description', 'meneger_id'];

    public function children(){
        return $this->belongsTo(Childreen::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
