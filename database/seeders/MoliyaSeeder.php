<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Moliya;
class MoliyaSeeder extends Seeder{
    public function run(): void{
        Moliya::create([
            'kassa_naqt' => 0,
            'naqt_chiqim_pedding' => 0,
            'naqt_xarajat_pedding' => 0,
            'kassa_plastik' => 0,
            'plastik_chiqim_pedding' => 0,
            'plastik_xarajat_pedding' => 0,
            'balans_naqt' => 0,
            'balans_plastik' => 0,
        ]);
    }
}
