<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Programs;
use PhpParser\Node\Expr\FuncCall;
use Ramsey\Uuid\Uuid;

class ProgramsController extends Controller
{
    //
    public function index(Request $request){

        $search =  $request->search;

        $programs = Programs::where([
            ['name', 'LIKE', "%{$search}%"],
            //['active', '<>', 0]
        ])->latest()->paginate();

        return view('programs.index',[
            'programs' => $programs
        ]);
    }

    public function show(Programs $program){
        
        $program = Programs::with('user')->get()->where('id', '=', $program->id);
        // foreach ($program as $programs) {
        //     echo $programs->name . ' ' . $programs->code . ' ' . $programs->credits . ' ' . $programs->hours . ' ' . $programs->active . ' ' . $programs->user->name;
        // }
        //dd($program);
        return view('programs.show', [
            'program' => $program
        ]);
    }

    public function create(Programs $program){
        
        return view ('programs.create',[
            'program' => $program
        ]);
    }

    public function store(Request $request){
        //dd($request);

        $request->validate([
            'code' => 'required|unique:programs,code',
            'name'  => 'required',
            'active'  => 'required',
        ],[
            'code.required' => 'El campo código es requerido',
            'code.unique'    => 'El código debe ser unico (Ya existe este código)',
            'name.required'  => 'El campo nombre del programa es requerido',
            'active.required'    => 'Este campo es requerido',
        ]);

        $program = $request->user()->programs()->create([
            'id' => (String) Uuid::uuid4(),
            'code' => $request->code,
            'name' => $request->name,
            'credits' => $request->credits,
            'hours' => $request->hours,
            'active' => $request->active,
            
        ]);

        return redirect()->route('programs.edit', $program);
    }

    public function edit(Programs $program){
        return view('programs.edit', [
            'program' => $program
        ]);
    }

    public function update(Request $request, Programs $program){

        $request->validate([
            'code' => 'required|unique:programs,code,' . $program->id,
            'name'  => 'required',
            'active'  => 'required',
        ],[
            'code.required' => 'El campo código es requerido',
            'code.unique'    => 'El código debe ser unico (Ya existe este código)',
            'name.required'  => 'El campo nombre del programa es requerido',
            'active.required'    => 'Este campo es requerido',
        ]);

        $program->update([
            'code' => $request->code,
            'name' => $request->name,
            'credits' => $request->credits,
            'hours' => $request->hours,
            'active' => $request->active,
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        return redirect()->route('programs.edit', $program);
    }
    
    public function destroy(Programs $program){
        //dd($program);
        $program->delete();

        return back();
    }


}
