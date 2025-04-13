<?php
namespace App\Services;

use App\Models\VacancyChild;
use App\Http\Requests\PersonRequest;

class PersonService{
    
    public function store(PersonRequest $request){
        $data = $request->validated();
        $data['status'] = 'new';
        $data['name'] = strtoupper($data['name']);
        return VacancyChild::create($data);
    }

    
}