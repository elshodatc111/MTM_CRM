<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moliya extends Model
{
    use HasFactory;

    protected $fillable = [
        'kassa_naqt',
        'naqt_chiqim_pedding',
        'naqt_xarajat_pedding',
        'kassa_plastik',
        'plastik_chiqim_pedding',
        'plastik_xarajat_pedding',
        'balans_naqt',
        'balans_plastik',
    ];
}
