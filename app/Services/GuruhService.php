<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Guruh;

class GuruhService{

    public function getAll(){
        $Guruh = Guruh::get();
        $Guruhlar = [];
        foreach ($Guruh as $key => $value) {
            $Guruhlar[$key]['id'] = $value->id;
            $Guruhlar[$key]['name'] = $value->name;
            $Guruhlar[$key]['amount'] = number_format($value->amount, 0, '.', ' ');
            $Guruhlar[$key]['katta_tarbiyachi'] = $value->katta_tarbiyachi;
            $Guruhlar[$key]['kichik_tarbiyachi'] = $value->kichik_tarbiyachi;
            $Guruhlar[$key]['user_count'] = 0;
        }
        return $Guruhlar;
    }

    public function store(array $data){
        $data['amount'] = str_replace(' ', '', $data['amount']);
        $data['user_id'] = auth()->user()->id;
        return Guruh::create([
            'name' => strtoupper($data['name']),
            'amount' => $data['amount'],
            'katta_tarbiyachi' => $data['katta_tarbiyachi'],
            'kichik_tarbiyachi' => $data['kichik_tarbiyachi'],
            'user_id' => $data['user_id'], 
        ]);
    }


}
