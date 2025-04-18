<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Moliya;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\MoliyaSeeder;
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            //UserSeeder::class,
            MoliyaSeeder::class,
        ]);
    }
}
