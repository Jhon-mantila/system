<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Programs;
use PhpParser\Node\Expr\FuncCall;
use Ramsey\Uuid\Uuid;
use App\Services\DropdownService;

class ProgramsController extends Controller
{
    //
    protected $dropdownService;
    
    public function __construct(DropdownService $dropdownService)
    {
        $this->dropdownService = $dropdownService;
    }

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
        //dd($program);
        $activeOptions = $this->dropdownService->getActive();

        //$p = Programs::find('07184ec6-7f16-477c-aa89-53807f85c6a7')->courses()->orderBy('name')->get();;
        //dd($p);


        $program = Programs::with('user')->get()->where('id', '=', $program->id);
        // foreach ($program as $programs) {
        //     echo $programs->name . ' ' . $programs->code . ' ' . $programs->credits . ' ' . $programs->hours . ' ' . $programs->active . ' ' . $programs->user->name;
        // }
        //dd($program);
        return view('programs.show', [
            'program' => $program,
            'activeOptions' => $activeOptions
        ]);
    }

    public function create(Programs $program){
        
        $activeOptions = $this->dropdownService->getActive();

        return view ('programs.create',[
            'program' => $program,
            'activeOptions' => $activeOptions
        ]);
    }

    public function store(Request $request){
        //dd($request);

        $request->validate([
            'code' => 'required|unique:programs,code',
            'code_ocupation' => 'required',
            'name'  => 'required',
            'active'  => 'required',
        ],[
            'code.required' => 'El campo código norma es requerido',
            'code.unique'    => 'El código norma debe ser unico (Ya existe este código)',
            'code_ocupation.required' => 'El campo código ocupación es requerido',
            'name.required'  => 'El campo nombre del programa es requerido',
            'active.required'    => 'Este campo es requerido',
        ]);

        $program = $request->user()->programs()->create([
            'id' => (String) Uuid::uuid4(),
            'code' => $request->code,
            'code_ocupation' => $request->code_ocupation,
            'name' => $request->name,
            'credits' => $request->credits,
            'hours' => $request->hours,
            'active' => $request->active,
            
        ]);

        return redirect()->route('programs.edit', $program);
    }

    public function edit(Programs $program){

        $activeOptions = $this->dropdownService->getActive();

        return view('programs.edit', [
            'program' => $program,
            'activeOptions' => $activeOptions
        ]);
    }

    public function update(Request $request, Programs $program){

        //dd($request);
        $request->validate([
            'code' => 'required|unique:programs,code,' . $program->id,
            'code_ocupation' => 'required',
            'name'  => 'required',
            'active'  => 'required',
        ],[
            'code.required' => 'El campo código norma es requerido',
            'code.unique'    => 'El código debe ser unico (Ya existe este código)',
            'code_ocupation.required' => 'El campo código ocupación es requerido',
            'name.required'  => 'El campo nombre del programa es requerido',
            'active.required'    => 'Este campo es requerido',
        ]);

        $program->update([
            'code' => $request->code,
            'code_ocupation' => $request->code_ocupation,
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
