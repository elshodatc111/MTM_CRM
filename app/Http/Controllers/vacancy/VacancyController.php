<?php

namespace App\Http\Controllers\vacancy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVacancyRequest;
use App\Services\VacancyService;
use App\Models\VacanseHodim;

class VacancyController extends Controller{
    protected $service;

    public function __construct(VacancyService $service){
        $this->service = $service;
    }

    public function store(StoreVacancyRequest $request){
        $this->service->create($request);
        return redirect()->back()->with('success', 'Vakansiya muvaffaqiyatli qo‘shildi.');
    }

    public function index(){
        $hodimlar = VacanseHodim::orderBy('id', 'desc')->get();
        return view('vacancy.hodim.index',compact('hodimlar')); 
    }

}
