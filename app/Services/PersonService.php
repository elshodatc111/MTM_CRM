<?php
namespace App\Services;

use App\Models\VacancyChild;
use App\Models\VacancyChildComment;
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

    
}