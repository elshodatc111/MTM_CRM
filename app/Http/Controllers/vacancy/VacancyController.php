<?php

namespace App\Http\Controllers\vacancy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVacancyRequest;
use App\Services\VacancyService;
use App\Models\VacanseHodim;
use App\Models\VacancyComment;

class VacancyController extends Controller{
    protected $service;

    public function __construct(VacancyService $service){
        $this->service = $service;
    }

    public function store(StoreVacancyRequest $request){
        $this->service->create($request);
        return redirect()->back()->with('success', 'Vakansiya muvaffaqiyatli qo‘shildi.');
    }

    public function index(){
        $hodimlar = VacanseHodim::orderBy('id', 'desc')->get();
        return view('vacancy.hodim.index',compact('hodimlar')); 
    }

    public function show($id){
        $hodim = VacanseHodim::find($id);
        $comment = VacancyComment::where('vacancy_comments.vacancy_id', $id)
            ->join('users','users.id','vacancy_comments.user_id')
            ->select('vacancy_comments.comment','vacancy_comments.created_at','users.name')->get();
        return view('vacancy.hodim.show',compact('hodim','comment')); 
    }

    public function comment(Request $requser){
        $this->service->createComment([
            'id' => $requser->vacancy_id,
            'comment' => $requser->comment,
        ]);
        return redirect()->back()->with('success', 'Izoh saqlandi.');
    }

    public function cancel(Request $request){
        $this->service->Cancel([
            'id' => $request->vacancy_id,
            'comment' => $request->comment,
        ]);
        return redirect()->back()->with('success', 'Bekor qilindi.');
    }

    public function success(Request $request){
        $this->service->success([
            'vacancy_id' => $request->vacancy_id,
            'email' => $request->email,
            'type' => $request->type,
            'decription' => $request->decription,
        ]);
        return redirect()->back()->with('success', 'Muvaffaqiyatli ishga qabul qilindi.');
    }
}
