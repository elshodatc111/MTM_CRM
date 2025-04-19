<?php

namespace App\Http\Controllers\Kassa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\KassaService;
use App\Http\Requests\StoreChiqimMoliyaHistoryRequest;

class KassaController extends Controller{

    protected $kassa;

    public function __construct(KassaService $kassa){
        $this->kassa = $kassa;
    }


    public function index(){
        $kassa = $this->kassa->getKassa();
        return view('kassa.index',compact('kassa'));
    }

    public function kassaChiqim(StoreChiqimMoliyaHistoryRequest $request){
        $validated = $request->validated();
        $chiqim = $this->kassa->kassaChiqimPost($validated);
        if($chiqim){
            return redirect()->back()->with('success', 'Chiqim muvaffaqiyatli qo‘shildi!');
        }else{
            return redirect()->back()->with('success', 'Kassada yetarli mablag\' mavjud emas');
        }
    }
}
