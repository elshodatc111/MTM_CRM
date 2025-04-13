<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacancyComment extends Model{
    use HasFactory;

    protected $fillable = [
        'vacancy_id',
        'comment',
        'user_id',
    ];

    public function vacancy(){
        return $this->belongsTo(Vacancy::class);
    }

    // User bilan bog‘lanish
    public function user(){
        return $this->belongsTo(User::class);
    }
}
