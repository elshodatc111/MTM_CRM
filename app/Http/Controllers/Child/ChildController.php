<?php

namespace App\Http\Controllers\Child;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Childreen;
use App\Models\GuruhChildren;
use App\Services\ChildService;

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
        //dd($groupabout);
        return view('child.index_show',compact('about','groupabout','groupHistory'));
    }

    public function noindex(Request $request){
        $Childreen = $this->childService->getCanceledChildren($request);
        return view('child.no_index', compact('Childreen'));
    }

    public function noshow($id){
        dd("ChildController");
    }

}
