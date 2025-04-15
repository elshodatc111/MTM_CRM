<?php

namespace App\Http\Controllers\Group;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\AttachTeacherRequest;
use App\Http\Requests\StoreGuruhCommentRequest;
use App\Http\Requests\UpdateGuruhRequest;
use App\Http\Requests\UpdateTarbiyachiRequest;
use App\Services\GuruhService;
//use App\Models\GuruhTecher;

class GroupController extends Controller{
    
    protected $groupService;

    public function __construct(GuruhService $groupService){
        $this->groupService = $groupService;
    }

    public function index(){
        $group = $this->groupService->getAll();
        return view('group.index',compact('group'));
    }

    public function store(StoreGroupRequest $request){
        $this->groupService->store($request->validated());
        return redirect()->back()->with('success', 'Guruh muvaffaqiyatli saqlandi!');
    }

    public function attachTeacher(AttachTeacherRequest $request){
        $this->groupService->addGroupBigAttach($request->validated());
        return redirect()->back()->with('success', 'Tarbiyachi guruhga biriktirildi.');
    }

    public function storeComment(StoreGuruhCommentRequest $request){
        $this->groupService->createCommentStore($request->validated());
        return redirect()->back()->with('success', 'Kommentariya saqlandi.');
    }

    public function updateGroups(UpdateGuruhRequest $request){
        $this->groupService->updateGroup($request->validated());
        return redirect()->back()->with('success', 'Guruh malumotlari yangilandi.');
    }

    public function updateTecherGroup(UpdateTarbiyachiRequest $request){
        $this->groupService->updateTecherGroup($request->validated());
        return redirect()->back()->with('success', 'Tarbiyachi yangilandi.');
    }

    public function updateTecherMinGroup(UpdateTarbiyachiRequest $request){
        $this->groupService->updateTecherMinGroup($request->validated());
        return redirect()->back()->with('success', 'Tarbiyachi yangilandi.');
    }

    public function show($id){
        $about = $this->groupService->show($id);
        $katta_tarbiyachi = $this->groupService->kattaTarbiyachi($id);
        $kichikTarbiyachi = $this->groupService->kichikTarbiyachi($id);
        $tarbiyachiHistory = $this->groupService->tarbiyachiHistory($id);
        $comments = $this->groupService->groupComments($id);
       // $bolalar = $this->groupService->bolalar($id);
        //dd($bolalar);
        return view('group.show', compact('about','katta_tarbiyachi','kichikTarbiyachi','tarbiyachiHistory','comments'));
    }
    


}
