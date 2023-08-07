<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Programs;

class ProgramsController extends Controller
{
    //
    public function index(){
        return view('programs.index',[
            'programs' => Programs::latest()->paginate()
        ]);
    }
}
