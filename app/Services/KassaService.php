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

class KassaService{
    public function getKassa(){
        $Moliya = Moliya::first();
        return [
            'kassa_naqt' => $Moliya['kassa_naqt'],
            'naqt_chiqim_pedding' => $Moliya['naqt_chiqim_pedding'],
            'naqt_xarajat_pedding' => $Moliya['naqt_xarajat_pedding'],
            'kassa_plastik' => $Moliya['kassa_plastik'],
            'plastik_chiqim_pedding' => $Moliya['plastik_chiqim_pedding'],
            'plastik_xarajat_pedding' => $Moliya['plastik_xarajat_pedding'],
        ];
    }

    public function getMoliyaHistory(){
        $MoliyaHistory = MoliyaHistory::where('status','pedding')->get();
        $array = [];
        foreach ($MoliyaHistory as $key => $value) {
            $array[$key]['id'] = $value->id;
            $array[$key]['amount'] = $value->amount;
            $array[$key]['type'] = $value->type;
            $array[$key]['meneger'] = User::find($value->start_meneger_id)->name;
            $array[$key]['start_description'] = $value->start_description;
            $array[$key]['created_at'] = $value->created_at;
        }
        return $array;
    }

    public function kassaChiqimPost(array $data){
        $mavjud_naqt = $data['kassa_naqt'];
        $mavjud_plastik = $data['kassa_plastik'];
        $chiqim = str_replace(" ","",$data['amount']);
        $type = $data['type'];
        $start_description = $data['start_description'];
        if($chiqim == 0){
            return false;
        }
        $Moliya = Moliya::first();
        if($type == 'kassa_chiqim_naqt'){
            if($mavjud_naqt<$chiqim){
                return false;
            }
            $Moliya->kassa_naqt = $Moliya->kassa_naqt - $chiqim;
            $Moliya->naqt_chiqim_pedding = $Moliya->naqt_chiqim_pedding + $chiqim;
        }
        if($type == 'kassa_chiqim_pastik'){
            if($mavjud_plastik<$chiqim){
                return false;
            }
            $Moliya->kassa_plastik = $Moliya->kassa_plastik - $chiqim;
            $Moliya->plastik_chiqim_pedding = $Moliya->plastik_chiqim_pedding + $chiqim;
        }
        MoliyaHistory::create([
            'amount' => $chiqim,
            'type' => $type,
            'status' => 'pedding',
            'start_meneger_id' => auth()->user()->id,
            'start_description' => $start_description,
        ]); 
        $Moliya->save();
        return true;
    }

    public function kassaXarajatPost(array $data){
        $mavjud_naqt = $data['kassa_naqt'];
        $mavjud_plastik = $data['kassa_plastik'];
        $chiqim = str_replace(" ","",$data['amount']);
        $type = $data['type'];
        $start_description = $data['start_description'];
        if($chiqim == 0){
            return false;
        }
        $Moliya = Moliya::first();
        if($type == 'kassa_xarajat_naqt'){
            if($mavjud_naqt<$chiqim){
                return false;
            }
            $Moliya->kassa_naqt = $Moliya->kassa_naqt - $chiqim;
            $Moliya->naqt_xarajat_pedding = $Moliya->naqt_xarajat_pedding + $chiqim;
        }
        if($type == 'kassa_xarajat_plastik'){
            if($mavjud_plastik<$chiqim){
                return false;
            }
            $Moliya->kassa_plastik = $Moliya->kassa_plastik - $chiqim;
            $Moliya->plastik_xarajat_pedding = $Moliya->plastik_xarajat_pedding + $chiqim;
        }
        MoliyaHistory::create([
            'amount' => $chiqim,
            'type' => $type,
            'status' => 'pedding',
            'start_meneger_id' => auth()->user()->id,
            'start_description' => $start_description,
        ]); 
        $Moliya->save();
        return true;
    }

    public function chiqimTrash($id){
        $MoliyaHistory = MoliyaHistory::find($id);
        $amount = str_replace(" ","",$MoliyaHistory['amount']);
        $Moliya = Moliya::first();
        if($MoliyaHistory->type == 'kassa_chiqim_naqt'){
            $Moliya->kassa_naqt = $Moliya->kassa_naqt + $amount;
            $Moliya->naqt_chiqim_pedding = $Moliya->naqt_chiqim_pedding - $amount;
        }elseif($MoliyaHistory->type == 'kassa_chiqim_pastik'){
            $Moliya->kassa_plastik = $Moliya->kassa_plastik + $amount;
            $Moliya->plastik_chiqim_pedding = $Moliya->plastik_chiqim_pedding - $amount;
        }elseif($MoliyaHistory->type == 'kassa_xarajat_plastik'){
            $Moliya->kassa_plastik = $Moliya->kassa_plastik + $amount;
            $Moliya->plastik_xarajat_pedding = $Moliya->plastik_xarajat_pedding - $amount;
        }elseif($MoliyaHistory->type == 'kassa_xarajat_naqt'){
            $Moliya->kassa_naqt = $Moliya->kassa_naqt + $amount;
            $Moliya->naqt_xarajat_pedding = $Moliya->naqt_xarajat_pedding - $amount;
        }
        $Moliya->save();
        return $MoliyaHistory->delete();
    }

    public function kassaSuccess(int $id){
        $MoliyaHistory = MoliyaHistory::find($id);
        $amount = str_replace(" ","",$MoliyaHistory['amount']);
        $Moliya = Moliya::first();
        if($MoliyaHistory->type == 'kassa_chiqim_naqt'){
            $Moliya->naqt_chiqim_pedding = $Moliya->naqt_chiqim_pedding - $amount;
            $Moliya->balans_naqt = $Moliya->balans_naqt + $amount;
        }elseif($MoliyaHistory->type == 'kassa_chiqim_pastik'){
            $Moliya->plastik_chiqim_pedding = $Moliya->plastik_chiqim_pedding - $amount;
            $Moliya->balans_plastik = $Moliya->balans_plastik - $amount;
        }elseif($MoliyaHistory->type == 'kassa_xarajat_plastik'){
            $Moliya->plastik_xarajat_pedding = $Moliya->plastik_xarajat_pedding - $amount;
        }elseif($MoliyaHistory->type == 'kassa_xarajat_naqt'){
            $Moliya->naqt_xarajat_pedding = $Moliya->naqt_xarajat_pedding - $amount;
        }
        $Moliya->save();
        $MoliyaHistory->end_meneger_id = auth()->user()->id;
        $MoliyaHistory->status = 'success';
        return $MoliyaHistory->save();
    }


}