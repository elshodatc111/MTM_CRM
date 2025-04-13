<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VacancyChild extends Model{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'birthday',
        'phone1',
        'phone2',
        'description',
        'status',
    ];

    public function comments(){
        return $this->hasMany(VacancyChildComment::class);
    }
}
