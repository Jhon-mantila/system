<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;

class StudentsController extends Controller
{
    //
    public function index(Request $request){

        $search =  $request->search;

        $students = Students::latest()->paginate();

        return view('students.index',[
            'students' => $students
        ]);
    }
}
