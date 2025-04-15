<?php
namespace App\Services;

use App\Models\VacancyChild;
use App\Models\VacancyChildComment;
use App\Models\Guruh;
use App\Models\Childreen;
use App\Models\Relatives;
use App\Models\GuruhChildren;
use App\Http\Requests\PersonRequest; 

class PersonService{
    
    public function store(PersonRequest $request){
        $data = $request->validated();
        $data['status'] = 'new';
        $data['name'] = strtoupper($data['name']);
        return VacancyChild::create($data);
    }

    public function CommentStore(array $data){
        $data['user_id'] = auth()->user()->id;
        return VacancyChildComment::create($data);
    }

    public function CancelStore(array $data){
        $data['user_id'] = auth()->user()->id;
        $data['comment'] = "Bekor qilindi: ".$data['comment'];
        VacancyChildComment::create($data);
        $vacancyChild = VacancyChild::findOrFail($data['vacancy_child_id']);
        $vacancyChild->status = 'cancel';
        return $vacancyChild->save();
    }

    public function getGroups(){
        return Guruh::get();
    }

    protected function VacancyChildSuccess($id){
        $VacancyChild = VacancyChild::findOrFail($id);
        $VacancyChild->status = 'success';
        return $VacancyChild->save();
    }

    protected function VacancyChildSuccessComments($id,$message){
        return VacancyChildComment::create([
            'vacancy_child_id' => $id,
            'comment' => $message,
            'user_id' => auth()->user()->id,
        ]);
    }

    protected function createChildren($vacancy_child_id){
        $data = VacancyChild::findOrFail($vacancy_child_id)->toArray();
        $Childreen = Childreen::create([
            'name' => strtoupper($data['name']),
            'address' => $data['address'],
            'birthday' => $data['birthday'],
            'balans' => 0,
            'description' => $data['description'],
            'status' => 'true',
            'user_id' => auth()->user()->id,
        ]);
        return $Childreen->id;
    }

    public function createRelatives($children_id, array $data){
        $name = $data['qarindosh'];
        //dd($data);
        return Relatives::create([
            'children_id' => $children_id,
            'kim' => $name,
            'name' => strtoupper($data['fio']),
            'phone1' => $data['phone1'],
            'phone2' => $data['phone2'],
            'user_id' => auth()->user()->id,
        ]);
    }

    public function createGuruhChildren($guruh_id, $children_id,$description){
        return GuruhChildren::create([
            'guruh_id' => $guruh_id,
            'children_id' => $children_id,
            'start_date' => date('Y-m-d'),
            'start_description' => $description,
            'start_user_id' => auth()->user()->id,
            'end_date' => date('Y-m-d'),
            'end_description' => ' ',
            'end_user_id' => auth()->user()->id,
            'status' => 'true',
        ]);
    }

    public function SuccessStore(array $data){
        $this->VacancyChildSuccess($data['vacancy_child_id']);
        $this->VacancyChildSuccessComments($data['vacancy_child_id'],$data['start_description']);
        $ChildreenID = $this->createChildren($data['vacancy_child_id']);
        $this->createRelatives($ChildreenID, $data);
        $this->createGuruhChildren($data['guruh_id'], $ChildreenID, $data['start_description']);
        return true;
    }

    
}