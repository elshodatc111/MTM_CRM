<?php

namespace App\Http\Controllers\Moliya;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MoliyaService;
use App\Http\Requests\BalansChiqimRequest;

class MoliyaController extends Controller{
    protected $moliya;

    public function __construct(MoliyaService $moliya){
        $this->moliya = $moliya;
    }

    public function index(){
        $Balans = $this->moliya->getBalans();
        $History = $this->moliya->BalansHistory(7);
        $Paymart = $this->moliya->PaymartHistory(7);
        $ChegirmaQaytar = $this->moliya->chegirmaQaytar(7);
        //dd($ChegirmaQaytar);
        return view('moliya.index',compact('Balans','History','Paymart','ChegirmaQaytar'));
    }

    public function chiqimSaqlash(BalansChiqimRequest $request){
        $data = $request->validated();
        $chiqim = $this->moliya->balansdanChiqim($data);
        if($chiqim){
            return redirect()->back()->with('success', 'Chiqim muvaffaqiyatli saqlandi!');
        }else{
            return redirect()->back()->with('success', 'Balansda yetarli mablag\' mavjud emas!');
        }
    }

    public function xarajatSaqlash(BalansChiqimRequest $request){
        $data = $request->validated();
        $chiqim = $this->moliya->balansdanXarajat($data);
        if($chiqim){
            return redirect()->back()->with('success', 'Xarajat muvaffaqiyatli saqlandi!');
        }else{
            return redirect()->back()->with('success', 'Balansda yetarli mablag\' mavjud emas!');
        }  
    }
}
