<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Guruh;
use App\Models\GuruhTecher;

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

    public function show(int $id){
        $guruh = Guruh::find($id);
        $GuruhTecher = GuruhTecher::where('guruh_id',$id)->where('status','true')->get();
        $katta_tarbiyachi = "Tanlanmagan";
        $kichik_tarbiyachi = "Tanlanmagan";
        foreach ($GuruhTecher as $key => $value) {
            $User = User::find($value['user_id']);
            if($User['type']=='tarbiyachi'){
                $katta_tarbiyachi = $User->name;
            }
            if($User['type']=='kichik_tarbiyachi'){
                $kichik_tarbiyachi = $User->name;
            }
        }
        return [
            'id' => $guruh['id'],
            'name' => $guruh['name'],
            'amount' => $guruh['amount']*100/100,
            'katta_tarbiyachi' => $katta_tarbiyachi,
            'katta_amount' => $guruh['katta_tarbiyachi']*100/100,
            'kichik_tarbiyachi' => $kichik_tarbiyachi,
            'kichik_amount' => $guruh['kichik_tarbiyachi']*100/100,
            'bolalar' => 0,
            'meneger' => User::find($guruh['user_id'])->name,
            'created_at' => $guruh['created_at'],
            'updated_at' => $guruh['updated_at'],
        ];
    }

    public function kattaTarbiyachi(int $id){
        $Users = User::where('type','tarbiyachi')->where('status','true')->get();
        $Tarbiyachilar = [];
        foreach ($Users as $key => $value) {
            if(!GuruhTecher::where('guruh_id',$id)->where('status','true')->where('user_id',$value->id)->first()){
                $Tarbiyachilar[$key]['id'] = $value->id;
                $Tarbiyachilar[$key]['name'] = $value->name;
            }
        }
        return $Tarbiyachilar;
    }

    public function kichikTarbiyachi(int $id){
        $Users = User::where('type','kichik_tarbiyachi')->where('status','true')->get();
        $Tarbiyachilar = [];
        foreach ($Users as $key => $value) {
            if(!GuruhTecher::where('guruh_id',$id)->where('status','true')->where('user_id',$value->id)->first()){
                $Tarbiyachilar[$key]['id'] = $value->id;
                $Tarbiyachilar[$key]['name'] = $value->name;
            }
        }
        return $Tarbiyachilar;
    }

    public function addGroupBigAttach(array $data){
        return GuruhTecher::create([
            'guruh_id'=>$data['guruh_id'],
            'user_id'=>$data['user_id'],
            'start_date'=>date("Y-m-d"),
            'start_description'=>$data['start_description'],
            'start_meneger_id'=>auth()->user()->id,
            'end_date'=>date("Y-m-d"),
            'end_description'=>' ',
            'end_meneger_id'=>auth()->user()->id,
            'status'=>'true',
        ]);
    }

    public function tarbiyachiHistory($id){
        $GuruhTecher = GuruhTecher::where('guruh_id',$id)->get();
        $array = [];
        foreach ($GuruhTecher as $key => $value) {
            $array[$key]['user_id'] = $value->user_id;
            $array[$key]['tarbiyachi'] = User::find($value->user_id)->name;
            $array[$key]['start_date'] = $value->start_date;
            $array[$key]['start_description'] = $value->start_description;
            $array[$key]['start_meneger'] = User::find($value->start_meneger_id)->name;
            $array[$key]['end_date'] = $value->status=='true'?' ':$value->end_date;
            $array[$key]['end_description'] = $value->status=='true'?' ':$value->end_description;
            $array[$key]['end_meneger_id'] = $value->status=='true'?' ':User::find($value->end_meneger_id)->name;
            $array[$key]['status'] = $value->status;
        }
        return $array;
    }


}
