<?php

namespace App\Http\Controllers\Child;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChildController extends Controller{
    public function index(){
        dd("ChildController");
    }

    public function show($id){
        dd("ChildController");
    }
}
