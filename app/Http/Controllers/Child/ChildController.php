<?php

namespace App\Http\Controllers\Child;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ChildService;
use App\Http\Requests\StoreGuardianRequest;

class ChildController extends Controller{
    protected $childService;

    public function __construct(ChildService $childService){
        $this->childService = $childService;
    }

    public function index(Request $request){
        $Childreen = $this->childService->getFilteredChildren($request);
        //dd($Childreen);
        return view('child.index', compact('Childreen'));
    }

    public function show($id){
        $about = $this->childService->getAboutChildren($id);
        $groupabout = $this->childService->getAboutGroupChildren($id);
        $groupHistory = $this->childService->getHistoryGroupChildren($id);
        $Relatives = $this->childService->getRelatives($id);
        //dd($Relatives);
        return view('child.index_show',compact('about','groupabout','groupHistory','Relatives'));
    }

    public function deleteRelatives(Request $request){
        $this->childService->deleteRelatives($request->id);
        return redirect()->back()->with('success', 'Tarbiyalanuvchi vasiysi o\'chirildi.');
    }

    public function addRelatives(StoreGuardianRequest $request){
        $this->childService->addRelatives($request->validated());
        return redirect()->back()->with('success', 'Yangi vasiy qo\'shildi.');
    }






    public function noindex(Request $request){
        $Childreen = $this->childService->getCanceledChildren($request);
        return view('child.no_index', compact('Childreen'));
    }

    public function noshow($id){
        dd("ChildController");
    }

}
