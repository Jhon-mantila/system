<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;

class StudentsController extends Controller
{
    //
    public function index(Request $request){

        $search =  $request->search;

        $students = Students::where('first_name', 'LIKE', "%{$search}%")
        ->orWhere('second_name', 'LIKE', "%{$search}%")
        ->orWhere('last_name', 'LIKE', "%{$search}%")
        ->orWhere('second_last_name', 'LIKE', "%{$search}%")
        ->latest()->paginate();

        return view('students.index',[
            'students' => $students
        ]);
    }

    public function create(Students $student){

        return view('students.create',[
            'student' => $student
        ]);
    }
    public function destroy(Students $student){

        $student->delete();

        return back();

    }
}
