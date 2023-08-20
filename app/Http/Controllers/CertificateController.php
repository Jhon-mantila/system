<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Programs;
use App\Models\Students;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class CertificateController extends Controller
{
    //
    public function index(Request $request){

        $search =  $request->search;
        //$certificates = Certificate::with(['user', 'program', 'student', 'employee', 'company'])
        $certificates = Certificate::with(['user', 'program', 'student'])
                ->whereHas('student', function ($query) use ($search) {
                    $query->where('first_name', 'LIKE', "%{$search}%")
                          ->orWhere('second_name', 'LIKE', "%{$search}%")
                          ->orWhere('last_name', 'LIKE', "%{$search}%")
                          ->orWhere('second_last_name', 'LIKE', "%{$search}%");
                })       
                ->latest()->paginate();

        //dd($certificates);
        return view('certificates.index',[
            'certificates' => $certificates
        ]);
    }

    public function create(Certificate $certificate){

        return view('certificates.create',[
            'certificate' => $certificate
        ]);
    }

    public function store(Request $request){
        
       /* $request->validate([
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
        ]);*/
        //dd($request);
        $certificate = $request->user()->certificates()->create([
            'id' => (String) Uuid::uuid4(),
            'program_id' => $request->program_id,
            'student_id' => $request->student_id,
            'employee_id' => $request->employee_id,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'company_id' => $request->company_id,
            'accredited' => $request->accredited,
            'notified' => $request->notified,
        ]);

        return redirect()->route('certificates.edit', $certificate);
    }

    public function edit(Certificate $certificate){

        return view('certificates.edit', [
            'certificate' => $certificate
        ]);
    }

    public function update(Request $request, Certificate $certificate){

        $certificate->update([
            'program_id' => $request->program_id,
            'student_id' => $request->student_id,
            'employee_id' => $request->employee_id,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'company_id' => $request->company_id,
            'accredited' => $request->accredited,
            'notified' => $request->notified,
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
       
        return redirect()->route('certificates.edit', $certificate);
    }

    public function searchPrograms(Request $request)
    {
        $search = $request->input('search');
       
        $programs = Programs::where('name', 'LIKE', "%$search%")->get();
        //dd($programs);
        //dd(response()->json($programs));
        return response()->json($programs);
    }

    public function searchProgramsId(Request $request)
    {
        $search = $request->input('search');

        $programs = Programs::where('id', '=', "$search")->get();
        //dd($programs);
        //dd(response()->json($programs));
        return response()->json($programs);
    }

    public function searchStudents(Request $request)
    {
        $search = $request->input('search');
       
        $students = Students::where('first_name', 'LIKE', "%$search%")
        ->orWhere('second_name', 'LIKE', "%{$search}%")
        ->orWhere('last_name', 'LIKE', "%{$search}%")
        ->orWhere('second_last_name', 'LIKE', "%{$search}%")
        ->get();
        //dd($programs);
        //dd(response()->json($programs));
        return response()->json($students);
    }
}
