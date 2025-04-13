<?php
namespace App\Services;

use App\Models\User;
use App\Models\VacanseHodim;
use App\Models\VacancyComment;
use App\Http\Requests\StoreVacancyRequest;
use Illuminate\Support\Facades\Hash;

class VacancyService{
    public function create(StoreVacancyRequest $request): VacanseHodim
    {
        return VacanseHodim::create([
            'name' => strtoupper($request->name),
            'addres' => $request->addres,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'description' => $request->decription,
            'type' => $request->type,
            'status' => 'new',
            'worked' => $request->worked,
            'worked_comment' => $request->decription,
        ]);
    }

    public function createComment(array $data){
        $hodim = VacanseHodim::find($data['id']);
        if($hodim->status=='new'){
            $hodim->status = 'pedding';
            $hodim->save();
        }
        return VacancyComment::create([
            'vacancy_id' => $data['id'],
            'comment' => $data['comment'],
            'user_id' => auth()->user()->id,
        ]);
    }

    public function Cancel(array $data){
        $hodim = VacanseHodim::find($data['id']);
        $hodim->status = 'cancel';
        $hodim->save();
        return VacancyComment::create([
            'vacancy_id' => $data['id'],
            'comment' => "bekor qilindi (".$data['comment'].")",
            'user_id' => auth()->user()->id,
        ]);
    }

    public function success(array $data){
        $hodim = VacanseHodim::find($data['vacancy_id']);
        $hodim->status = 'success';
        $hodim->save();
        VacancyComment::create([
            'vacancy_id' => $data['vacancy_id'],
            'comment' => $data['type']." Lovozimiga ishga olindi (".$data['decription'].")",
            'user_id' => auth()->user()->id,
        ]);
        return User::create([
            'name' => $hodim->name,
            'addres' => $hodim->addres,
            'phone' => $hodim->phone,
            'decription' => $data['decription'],
            'birthday' => $hodim->birthday,
            'type' => $data['type'],
            'status' => 'true',
            'email' => $data['email'],
            'password' => Hash::make('password'),
        ]);
    }
}
