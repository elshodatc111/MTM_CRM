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
        return $MoliyaHistory;
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
}