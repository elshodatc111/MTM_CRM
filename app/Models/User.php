<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable{
    use HasFactory, Notifiable, HasApiTokens;
    protected $fillable = [
        'name',
        'addres',
        'phone',
        'decription',
        'birthday',
        'type',
        'status',
        'email',
        'password',
    ];
    public function isActive(): bool{
        return $this->status === 'true';
    }
    public function isAdmin(): bool{
        return $this->type === 'admin';
    }
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected function casts(): array{
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function vacancyComments(){
        return $this->hasMany(VacancyComment::class);
    }
}
