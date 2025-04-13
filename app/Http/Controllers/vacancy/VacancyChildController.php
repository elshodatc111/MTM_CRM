<?php

namespace App\Http\Controllers\vacancy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PersonRequest;
use App\Services\PersonService;
use App\Models\VacancyChild;

class VacancyChildController extends Controller{
    protected $service;

    public function __construct(PersonService $service){
        $this->service = $service;
    }

    public function index(){
        $VacancyChild = VacancyChild::orderBy('id', 'desc')->get();
        return view('vacancy.child.index', compact('VacancyChild'));
    }

    public function store(PersonRequest $request){
        $this->service->store($request);
        return redirect()->back()->with('success', 'Maʼlumotlar saqlandi!');
    }

    public function show($id){
        $VacancyChild = VacancyChild::findOrFail($id);
        //dd($VacancyChild);
        return view('vacancy.child.show', compact('VacancyChild'));
    }

}
