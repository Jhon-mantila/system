<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Programs;

class ProgramsController extends Controller
{
    //
    public function index(Request $request){

        $search =  $request->search;

        $programs = Programs::where('name', 'LIKE', "%{$search}%")
        ->latest()->paginate();

        return view('programs.index',[
            'programs' => $programs
        ]);
    }
    
    public function destroy(Programs $program){
        //dd($program);
        $program->delete();

        return back();
    }


}
