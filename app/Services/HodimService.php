<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HodimService{


    public function createHodim($data){
        $hodim = new User();
        $hodim->name = strtoupper($data['name']);
        $hodim->addres = $data['addres'];
        $hodim->phone = $data['phone'];
        $hodim->birthday = $data['birthday'];
        $hodim->email = $data['email'];
        $hodim->decription = $data['decription'];
        $hodim->type = $data['type']; 
        $hodim->password = Hash::make('password');
        $hodim->save();
        return $hodim;
    }
}
