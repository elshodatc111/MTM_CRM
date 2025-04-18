<?php

namespace App\Http\Controllers\Child;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ChildService;
use App\Http\Requests\StoreGuardianRequest;
use App\Http\Requests\UpdateChildRequest;
use App\Http\Requests\ChangeGroupRequest;
use App\Http\Requests\LeaveKindergartenRequest;
use App\Http\Requests\CommentChildBolaRequest;
use App\Http\Requests\PaymartStoreRequest;

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
        $newGroup = $this->childService->newGroup($id);
        $comments = $this->childService->getComments($id);
        //dd($comments);
        return view('child.index_show',compact('about','groupabout','groupHistory','Relatives','newGroup','comments'));
    }

    public function deleteRelatives(Request $request){
        $this->childService->deleteRelatives($request->id);
        return redirect()->back()->with('success', 'Tarbiyalanuvchi vasiysi o\'chirildi.');
    }

    public function addRelatives(StoreGuardianRequest $request){
        $this->childService->addRelatives($request->validated());
        return redirect()->back()->with('success', 'Yangi vasiy qo\'shildi.');
    }

    public function childUpdate(UpdateChildRequest $request){
        $this->childService->childUpdate($request->validated());
        return redirect()->back()->with('success', 'Bola ma’lumotlari yangilandi.');
    }

    public function childChangeGroup(ChangeGroupRequest $request){
        $this->childService->changeGroups($request->validated());
        return redirect()->back()->with('success', 'Bola yangi guruhga o‘tkazildi.');
    }

    public function leave(LeaveKindergartenRequest $request){
        $this->childService->LeaveKindergartenRequest($request->validated());
        return back()->with('success', 'Bola bog‘chani tark etdi.');
    }

    public function childrebCommentBola(CommentChildBolaRequest $request){
        $this->childService->commentStore($request->validated());
        return redirect()->back()->with('success', 'Izoh muvaffaqiyatli saqlandi.');
    }

    public function PaymartStory(PaymartStoreRequest $request){
        $this->childService->PaymartStory($request->validated());
        return redirect()->back()->with('success', "To'lov muvaffaqiyatli saqlandi!");
    }



    public function noindex(Request $request){
        $Childreen = $this->childService->getCanceledChildren($request);
        return view('child.no_index', compact('Childreen'));
    }

    public function noshow($id){
        dd("ChildController");
    }

}
