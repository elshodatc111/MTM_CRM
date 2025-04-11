<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{

    public function run(): void{    
        $users = [
        [
            'name' => 'Admin User',
            'addres' => 'Toshkent',
            'phone' => '+998901234567',
            'decription' => 'Bosh admin foydalanuvchi',
            'birthday' => '1990-01-01',
            'type' => 'admin',
            'status' => 'true',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
        ],
        [
            'name' => 'Meneger User',
            'addres' => 'Samarqand',
            'phone' => '+998911112233',
            'decription' => 'Bog‘cha menegeri',
            'birthday' => '1985-06-15',
            'type' => 'meneger',
            'status' => 'true',
            'email' => 'meneger@test.com',
            'password' => Hash::make('password'),
        ],
        [
            'name' => 'kichik_tarbiyachi User',
            'addres' => 'Buxoro',
            'phone' => '+998933335577',
            'decription' => 'oshpaz xodimi',
            'birthday' => '1995-09-30',
            'type' => 'kichik_tarbiyachi',
            'status' => 'true',
            'email' => 'kichik_tarbiyachi@test.com',
            'password' => Hash::make('password'),
        ],
        [
            'name' => 'tarbiyachi User',
            'addres' => 'Buxoro',
            'phone' => '+998933335577',
            'decription' => 'oshpaz xodimi',
            'birthday' => '1995-09-30',
            'type' => 'tarbiyachi',
            'status' => 'true',
            'email' => 'tarbiyachi@test.com',
            'password' => Hash::make('password'),
        ],
        [
            'name' => 'techer2 User',
            'addres' => 'Buxoro',
            'phone' => '+998933335577',
            'decription' => 'oshpaz xodimi',
            'birthday' => '1995-09-30',
            'type' => 'techer',
            'status' => 'true',
            'email' => 'techer2@test.com',
            'password' => Hash::make('password'),
        ],
        [
            'name' => 'techer User',
            'addres' => 'Buxoro',
            'phone' => '+998933335577',
            'decription' => 'oshpaz xodimi',
            'birthday' => '1995-09-30',
            'type' => 'techer',
            'status' => 'true',
            'email' => 'techer@test.com',
            'password' => Hash::make('password'),
        ],
        [
            'name' => 'oshpaz User',
            'addres' => 'Buxoro',
            'phone' => '+998933335577',
            'decription' => 'oshpaz xodimi',
            'birthday' => '1995-09-30',
            'type' => 'oshpaz',
            'status' => 'true',
            'email' => 'oshpaz@test.com',
            'password' => Hash::make('password'),
        ],
        [
            'name' => 'Farrosh User',
            'addres' => 'Buxoro',
            'phone' => '+998933335577',
            'decription' => 'Farrosh xodimi',
            'birthday' => '1995-09-30',
            'type' => 'farrosh',
            'status' => 'true',
            'email' => 'farrosh@test.com',
            'password' => Hash::make('password'),
        ],
        [
            'name' => 'Bog\'bon User',
            'addres' => 'Buxoro',
            'phone' => '+998933335577',
            'decription' => 'Bog\'bon xodimi',
            'birthday' => '1995-09-30',
            'type' => 'bogbon',
            'status' => 'true',
            'email' => 'bogbon@test.com',
            'password' => Hash::make('password'),
        ],
        [
            'name' => 'Qarovul User',
            'addres' => 'Buxoro',
            'phone' => '+998933335577',
            'decription' => 'Qarovul xodimi',
            'birthday' => '1995-09-30',
            'type' => 'qarovul',
            'status' => 'true',
            'email' => 'qarovul@test.com',
            'password' => Hash::make('password'),
        ],
    ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
