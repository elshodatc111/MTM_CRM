<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VacanseHodim extends Model{
    protected $fillable = [
        'name', 
        'addres', 
        'phone', 
        'birthday', 
        'worked',
        'worked_comment', 
        'description', 
        'type', 
        'status'
    ];

    const TYPES = ['oshpaz', 'qarovul', 'bogbon', 'farrosh', 'techer'];
    const STATUSES = ['new', 'pedding', 'cancel', 'success'];

    public static function boot(){
        parent::boot();

        static::creating(function ($model) {
            if (!in_array($model->type, self::TYPES)) {
                throw new \InvalidArgumentException("Invalid type value.");
            }
            if (!in_array($model->status, self::STATUSES)) {
                throw new \InvalidArgumentException("Invalid status value.");
            }
        });
    }
}
