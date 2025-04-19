<?php
namespace App\Services;

use App\Models\Childreen;
use Illuminate\Http\Request;
use App\Services\ChildService;
use App\Models\User;
use App\Models\Guruh;
use App\Models\GuruhChildren;
use App\Models\Relatives;
use App\Models\ChildrenComment;
use App\Models\Paymart;
use App\Models\Moliya;
use App\Models\MoliyaHistory;

class MoliyaService{
    
    public function getBalans(){
        $Moliya = Moliya::first();
        return [
            "kassa_naqt" => $Moliya['kassa_naqt'],
            "naqt_chiqim_pedding" => $Moliya['naqt_chiqim_pedding'],
            "naqt_xarajat_pedding" => $Moliya['naqt_xarajat_pedding'],
            "kassa_plastik" => $Moliya['kassa_plastik'],
            "plastik_chiqim_pedding" => $Moliya['plastik_chiqim_pedding'],
            "plastik_xarajat_pedding" => $Moliya['plastik_xarajat_pedding'],
            "balans_naqt" => $Moliya['balans_naqt'],
            "balans_plastik" => $Moliya['balans_plastik'],
        ];
    }
    
    public function balansdanChiqim(array $data){
        $balans_naqt = $data['balans_naqt'];
        $balans_plastik = $data['balans_plastik'];
        $amount =  str_replace(" ","",$data['amount']);
        $type = $data['type'];
        $start_description = $data['start_description'];
        $Moliya = Moliya::first();
        if($type == 'moliya_chiqim_naqt'){
            if($balans_naqt<$amount){return false;}
            $Moliya->balans_naqt = $Moliya->balans_naqt - $amount;
        }
        if($type == 'moliya_chiqim_pastik'){
            if($balans_plastik<$amount){return false;}
            $Moliya->balans_plastik = $Moliya->balans_plastik - $amount;
        }
        $Moliya->save();
        MoliyaHistory::create([
            'amount' => $amount,
            'type' => $type,
            'status' => 'success',
            'start_meneger_id' => auth()->user()->id,
            'start_description' => $start_description,
            'end_meneger_id' => auth()->user()->id,
        ]);
        return true;
    }

    public function balansdanXarajat(array $data){
        $balans_naqt = $data['balans_naqt'];
        $balans_plastik = $data['balans_plastik'];
        $amount =  str_replace(" ","",$data['amount']);
        $type = $data['type'];
        $start_description = $data['start_description'];
        $Moliya = Moliya::first();
        if($type == 'moliya_xarajat_naqt'){
            if($balans_naqt<$amount){return false;}
            $Moliya->balans_naqt = $Moliya->balans_naqt - $amount;
        }
        if($type == 'moliya_xarajat_plastik'){
            if($balans_plastik<$amount){return false;}
            $Moliya->balans_plastik = $Moliya->balans_plastik - $amount;
        }
        $Moliya->save();
        MoliyaHistory::create([
            'amount' => $amount,
            'type' => $type,
            'status' => 'success',
            'start_meneger_id' => auth()->user()->id,
            'start_description' => $start_description,
            'end_meneger_id' => auth()->user()->id,
        ]);
        return true;
    }

    public function BalansHistory(int $day){
        $oldDate = date('Y-m-d', strtotime('-'.$day.' days'));
        $MoliyaHistory = MoliyaHistory::where('created_at','>=',$oldDate." 00:00:00")->where('status','success')->orderby('created_at','desc')->get();
        $array = [];
        foreach ($MoliyaHistory as $key => $value) {
            $array[$key]['type'] = $value->type;
            $array[$key]['amount'] = $value->amount;
            $array[$key]['description'] = $value->start_description;
            $array[$key]['meneger'] = User::find($value->start_meneger_id)->name;
            $array[$key]['created_at'] = $value->created_at;
        }
        return $array;
    }

    public function PaymartHistory(int $day){
        $oldDate = date('Y-m-d', strtotime('-'.$day.' days'));
        $Paymart = Paymart::where('status','tulov')->where('created_at','>=',$oldDate." 00:00:00")->get();
        $array = [];
        foreach ($Paymart as $key => $value) {
            $array[$key]['id'] = $value['id'];
            $array[$key]['children_id'] = $value['children_id'];
            $array[$key]['children'] = Childreen::find($value['children_id'])->name;
            $array[$key]['name'] = User::find($value['user_id'])->name;
            $array[$key]['amount'] = $value['amount'];
            $array[$key]['type'] = $value['type'];
            $array[$key]['discription'] = $value['discription'];
            $array[$key]['created_at'] = $value['created_at'];
        }
        return $array;
    }

    public function chegirmaQaytar(int $day){
        $oldDate = date('Y-m-d', strtotime('-'.$day.' days'));
        $Paymart = Paymart::whereIn('status', ['chegirma', 'qaytarildi'])->where('created_at', '>=', $oldDate . " 00:00:00")->get();
        $array = [];
        foreach ($Paymart as $key => $value) {
            $array[$key]['id'] = $value['id'];
            $array[$key]['children_id'] = $value['children_id'];
            $array[$key]['children'] = Childreen::find($value['children_id'])->name;
            $array[$key]['name'] = User::find($value['user_id'])->name;
            $array[$key]['amount'] = $value['amount'];
            $array[$key]['type'] = $value['type'];
            $array[$key]['status'] = $value['status'];
            $array[$key]['discription'] = $value['discription'];
            $array[$key]['created_at'] = $value['created_at'];
        }
        return $array;
    }



}