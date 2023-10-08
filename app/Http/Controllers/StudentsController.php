<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Models\Students;
use Ramsey\Uuid\Uuid;
use App\Services\DropdownService;

class StudentsController extends Controller
{
    //

    protected $dropdownService;
    
    public function __construct(DropdownService $dropdownService)
    {
        $this->dropdownService = $dropdownService;
    }

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

    public function show(Students $student){
        
        $activeOptions = $this->dropdownService->getActive();
        $typeDocument = $this->dropdownService->getTypeDocumento();

        $student = Students::with('user')->get()->where('id', '=', $student->id);
        //dd($student);
        return view('students.show', [
            'student' => $student,
            'activeOptions' => $activeOptions,
            'typeDocument' => $typeDocument,
        ]);
    }

    public function create(Students $student){

        $activeOptions = $this->dropdownService->getActive();
        $typeDocument = $this->dropdownService->getTypeDocumento();

        return view('students.create',[
            'student' => $student,
            'activeOptions' => $activeOptions,
            'typeDocument' => $typeDocument,
        ]);
    }

    public function store(Request $request){
        
        $request->validate([
            'first_name' => 'required',
            'document'  => 'required|unique:students,document',
            'last_name'  => 'required',
            'mobile'  => 'required',
            'email'  => 'required',
        ],[
            'first_name.required' => 'El primer nombre es requerido',
            'document.required'  => 'El documento es obligatorio',
            'document.unique'    => 'El documento debe ser único',
            'last_name.required'  => 'El primer apellido es requerido',
            'mobile.required'  => 'El celular es requerido',
            'email.required'  => 'El correo electronico es requerido',
        ]);

        $student = $request->user()->students()->create([
            'id' => (String) Uuid::uuid4(),
            'type_document' => $request->type_document,
            'document' => $request->document,
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'last_name' => $request->last_name,
            'second_last_name' => $request->second_last_name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'city' => $request->city,
            'active' => $request->active
        ]);
        
       
        return redirect()->route('students.edit', $student);

    }

    public function edit(Students $student){

        $activeOptions = $this->dropdownService->getActive();
        $typeDocument = $this->dropdownService->getTypeDocumento();

        return view('students.edit', [
            'student' => $student,
            'activeOptions' => $activeOptions,
            'typeDocument' => $typeDocument,
        ]);
    }

    public function update(Request $request, Students $student){

        $request->validate([
            'first_name' => 'required',
            'document'  => 'required|unique:students,document,' . $student->id,
            'last_name'  => 'required',
            'mobile'  => 'required',
            'email'  => 'required',
        ],[
            'first_name.required' => 'El primer nombre es requerido',
            'document.required'  => 'El documento es obligatorio',
            'document.unique'    => 'El documento debe ser único',
            'last_name.required'  => 'El primer apellido es requerido',
            'mobile.required'  => 'El celular es requerido',
            'email.required'  => 'El correo electronico es requerido',
        ]);

        $student->update([
            'type_document' => $request->type_document,
            'document' => $request->document,
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'last_name' => $request->last_name,
            'second_last_name' => $request->second_last_name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'city' => $request->city,
            'active' => $request->active,
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        
       
        return redirect()->route('students.edit', $student);
    }

    public function destroy(Students $student){

        $student->delete();

        return back();

    }

    public function apiStudents(Request $request)
    {
        $perPage = 5; // Cantidad de estudiantes por página
        $currentPage = $request->query('page', 1); // Página actual
        $searchById = $request->query('searchById');

        $students = Certificate::with(['user', 'program', 'student'])
        ->whereHas('student', function ($query) use ($searchById) {
                    $query->where('id', '=', "{$searchById}");
                }) 
        ->paginate($perPage, ['*'], 'page', $currentPage);

        return response()->json($students);
    }
}
