<?php

namespace App\Http\Controllers\hodim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\HodimService;
use App\Http\Requests\HodimCreateRequest;

class HodimeController extends Controller{
    
    protected $hodimService;
    public function __construct(HodimService $hodimService){
        $this->hodimService = $hodimService;
    }

    public function meneger(){
        $User = User::where('type', 'meneger')->get();
        return view('hodim.meneger',compact('User'));
    }

    public function tarbiyachi(){
        $User = User::whereIn('type', ['tarbiyachi', 'kichik_tarbiyachi'])->get();
        return view('hodim.tarbiyachi',compact('User'));
    }

    public function oqituvchi(){
        $User = User::where('type', 'techer')->get();
        return view('hodim.oqituvchi',compact('User'));
    }

    public function oshpaz(){
        $User = User::where('type', 'oshpaz')->get();
        return view('hodim.oshpaz',compact('User'));
    }
    
    public function hodimlar(){
        $User = User::whereIn('type', ['qarovul', 'bogbon','farrosh'])->get();
        return view('hodim.hodimlar',compact('User'));
    }

    public function store_create(HodimCreateRequest $request){
        $data = $request->validated();
        $hodim = $this->hodimService->createHodim($data);
        return redirect()->back()->with('success', 'Hodim muvaffaqiyatli qo\'shildi');
    }

    
}
