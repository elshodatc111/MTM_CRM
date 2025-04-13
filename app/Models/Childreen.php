<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Childreen extends Model
{
    use HasFactory;

    protected $table = 'children';

    protected $fillable = [
        'vacancy_child_id',
        'name',
        'address',
        'birthday',
        'balans',
        'description',
        'status',
        'user_id',
    ];

    public function vacancyChild()
    {
        return $this->belongsTo(VacancyChild::class);
    }

    public function relatives()
    {
        return $this->hasMany(Relative::class, 'children_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
