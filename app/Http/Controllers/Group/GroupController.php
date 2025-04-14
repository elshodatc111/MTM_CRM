<?php

namespace App\Http\Controllers\Group;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGroupRequest;
use App\Services\GuruhService;

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

    public function show($id){
        return view('group.show', [
            'group' => $this->groupService->getAll(),
            'id' => $id,
        ]);
    }


}
