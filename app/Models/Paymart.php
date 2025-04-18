<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paymart extends Model
{
    use HasFactory;

    protected $fillable = [
        'children_id',
        'user_id',
        'amount',
        'type',
        'status',
        'discription',
    ];

    public function child()
    {
        return $this->belongsTo(Children::class, 'children_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
