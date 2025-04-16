<?php

namespace App\Http\Controllers\Child;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Childreen;

class ChildController extends Controller{
    public function index(Request $request){
        $query = Childreen::query()->where('status', 'true');
        if ($request->filled('search')) {
            $request->validate([
                'search' => 'string|max:100',
            ]);
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }
        $Childreen = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();
        return view('child.index',compact('Childreen'));
    }

    public function show($id){
        return view('child.index_show');
    }

    public function noindex(Request $request){
        $query = Childreen::query()->where('status', 'cancel');
        if ($request->filled('search')) {
            $request->validate([
                'search' => 'string|max:100',
            ]);
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }
        $Childreen = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();
        return view('child.no_index',compact('Childreen'));
    }

    public function noshow($id){
        dd("ChildController");
    }

}
