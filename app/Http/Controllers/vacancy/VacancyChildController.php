<?php

namespace App\Http\Controllers\vacancy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PersonRequest;
use App\Http\Requests\CommentChildRequest;
use App\Http\Requests\CancelVacancyChildRequest;
use App\Services\PersonService;
use App\Models\VacancyChild;
use App\Models\VacancyChildComment;

class VacancyChildController extends Controller{
    protected $service;

    public function __construct(PersonService $service){
        $this->service = $service;
    }

    public function index(Request $request){
        $query = VacancyChild::query();
        if ($request->filled('search')) {
            $request->validate([
                'search' => 'string|max:100',
            ]);
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        $VacancyChild = $query->orderBy('id', 'desc')->paginate(20)->withQueryString();
        return view('vacancy.child.index', compact('VacancyChild'));
    }

    public function store(PersonRequest $request){
        $this->service->store($request);
        return redirect()->back()->with('success', 'Maʼlumotlar saqlandi!');
    }

    public function show($id){
        $VacancyChild = VacancyChild::findOrFail($id);
        $VacancyChildComment = VacancyChildComment::where('vacancy_child_id', $id)->orderBy('id', 'desc')->get();
        //dd($VacancyChild);
        return view('vacancy.child.show', compact('VacancyChild','VacancyChildComment'));
    }

    public function CommentStore(CommentChildRequest $request){
        $this->service->CommentStore($request->validated());
        return back()->with('success', 'Izoh saqlandi!');
    }

    public function CancelStore(CancelVacancyChildRequest $request){
        $this->service->CancelStore($request->validated());
        return back()->with('success', 'Bekor qilindi.');
    }

}
