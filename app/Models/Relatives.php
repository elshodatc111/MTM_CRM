<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Relatives extends Model
{
    use HasFactory;

    protected $fillable = [
        'children_id',
        'kin',
        'name',
        'phone1',
        'phone2',
        'user_id',
    ];

    public function child()
    {
        return $this->belongsTo(Child::class, 'children_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
