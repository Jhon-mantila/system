<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Company;
use App\Models\Course;
use App\Models\Employees;
use App\Models\Programs;
use App\Models\Students;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use App\Services\DropdownService;

class CertificateController extends Controller
{
    //
    
    protected $dropdownService;
    
    public function __construct(DropdownService $dropdownService)
    {
        $this->dropdownService = $dropdownService;
    }

    public function index(Request $request){

        $search =  $request->search;
        //$certificates = Certificate::with(['user', 'program', 'student', 'employee', 'company'])
        $certificates = Certificate::with(['user', 'program', 'student'])
                ->whereHas('student', function ($query) use ($search) {
                    $query->where('first_name', 'LIKE', "%{$search}%")
                          ->orWhere('second_name', 'LIKE', "%{$search}%")
                          ->orWhere('last_name', 'LIKE', "%{$search}%")
                          ->orWhere('second_last_name', 'LIKE', "%{$search}%")
                          ->orWhere('document', 'LIKE', "%{$search}%");
                })       
                ->latest()->paginate();
        $typeCertificate = $this->dropdownService->getTypeCertificate();
       
        //dd($certificates);
        return view('certificates.index',[
            'certificates' => $certificates,
            'typeCertificate' => $typeCertificate,

        ]);
    }

    public function show(Certificate $certificate){
        
        $typeCertificate = $this->dropdownService->getTypeCertificate();
        $accreditedOptions = $this->dropdownService->getAccredited();
        $typeCode = $this->dropdownService->getCode();

        $certificate = Certificate::with(['user', 'program', 'student', 'employee', 'company'])
        ->get()
        ->where('id', '=', $certificate->id);
        //dd($certificate);

        foreach($certificate as $valor){
            $programs = Programs::where('id', '=', "$valor->title")->get();
        }
        //dd($programs);
        return view('certificates.show', [
            'certificate' => $certificate,
            'typeCertificate' => $typeCertificate,
            'accreditedOptions' => $accreditedOptions,
            'typeCode' => $typeCode,
            'titulo' => $programs,
        ]);
    }

    public function create(Certificate $certificate){

        $typeCertificate = $this->dropdownService->getTypeCertificate();
        $accreditedOptions = $this->dropdownService->getAccredited();
        $typeCode = $this->dropdownService->getCode();

        return view('certificates.create',[
            'certificate' => $certificate,
            'typeCertificate' => $typeCertificate,
            'accreditedOptions' => $accreditedOptions,
            'typeCode' => $typeCode,

        ]);
    }

    public function store(Request $request){
        
        if($request->type_certificate == 'c'){
            $required = 'required';
            $required_certificate = '';
        }else if($request->type_certificate == 'cm'){
            $required_certificate = 'required';
            $required = '';
        }
       
        $request->validate([
            'program_id' => 'required',
            'student_id' => 'required',
            'employee_id' => 'required',
            'date_start' => $required,
            'date_end' => $required,
            'date_certificate' => $required_certificate,
            'type_certificate' => 'required'

        ],[
            'program_id.required' => 'El programa es requerido',
            'student_id.required' => 'El estudiante es requerido',
            'employee_id.required' => 'El empleado es requerido',
            'date_start.required' => 'La fecha inicial es requerida',
            'date_end.required' => 'La fecha final es requerida',
            'date_certificate.required' => 'La fecha del certificado es requerida',
            'type_certificate.required' => 'Es requerido',

        ]);

        $company = Company::all();
        //echo print_r($company, true);
        //dd($company[0]['id']);
        //dd($request);
        $certificate = $request->user()->certificates()->create([
            'id' => (String) Uuid::uuid4(),
            'program_id' => $request->program_id,
            'student_id' => $request->student_id,
            'employee_id' => $request->employee_id,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'date_certificate' => $request->date_certificate,
            'type_certificate' => $request->type_certificate,
            'company_id' => $company[0]['id'],
            'module' => 'programa',
            'title' => $request->title,
            'type_code' => $request->type_code,
            'references' => $request->references,
            'process' => $request->process,
            'accredited' => $request->accredited,
            'notified' => $request->notified,
        ]);

        return redirect()->route('certificates.edit', $certificate);
    }

    public function edit(Certificate $certificate){

        $typeCertificate = $this->dropdownService->getTypeCertificate();
        $accreditedOptions = $this->dropdownService->getAccredited();
        $typeCode = $this->dropdownService->getCode();

        return view('certificates.edit', [
            'certificate' => $certificate,
            'typeCertificate' => $typeCertificate,
            'accreditedOptions' => $accreditedOptions,
            'typeCode' => $typeCode,
        ]);
    }

    public function update(Request $request, Certificate $certificate){
            if($request->type_certificate == 'c'){
                $required = 'required';
                $required_certificate = '';
            }else if($request->type_certificate == 'cm'){
                $required_certificate = 'required';
                $required = '';
            }
        $request->validate([
            'program_id' => 'required',
            'student_id' => 'required',
            'employee_id' => 'required',
            'date_start' => $required,
            'date_end' => $required,
            'date_certificate' => $required_certificate,

        ],[
            'program_id.required' => 'El programa es requerido',
            'student_id.required' => 'El estudiante es requerido',
            'employee_id.required' => 'El empleado es requerido',
            'date_start.required' => 'La fecha inicial es requerida',
            'date_end.required' => 'La fecha final es requerida',
            'date_certificate.required' => 'La fecha del certificado es requerida',

        ]);
        //dd($request->type_certificate);
        $certificate->update([
            'program_id' => $request->program_id,
            'student_id' => $request->student_id,
            'employee_id' => $request->employee_id,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'date_certificate' => $request->date_certificate,
            'type_certificate' => $request->type_certificate,
            'title' => $request->title,
            'type_code' => $request->type_code,
            'references' => $request->references,
            'process' => $request->process,
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

    public function searchProgramsTitle(Request $request)
    {
        $search = $request->input('search');
       
        $programs = Programs::where('name', 'LIKE', "%$search%")
                                    ->where('certificate', 1)
                                    ->get();
        //dd($programs);
        //dd(response()->json($programs));
        return response()->json($programs);
    }

    public function searchStudents(Request $request)
    {
        $search = $request->input('search');
       
        $students = Students::whereRaw("CONCAT_WS(' ', first_name, second_name, last_name, second_last_name) LIKE ?", ["%$search%"])
        ->orWhere('first_name', 'LIKE', "%$search%")
        ->orWhere('second_name', 'LIKE', "%{$search}%")
        ->orWhere('last_name', 'LIKE', "%{$search}%")
        ->orWhere('document', 'LIKE', "%{$search}%")
        ->orWhere('second_last_name', 'LIKE', "%{$search}%")
        ->get();
        //dd($programs);
        //dd(response()->json($programs));
        return response()->json($students);
    }

    public function searchStudentsId(Request $request)
    {
        $search = $request->input('search');
       
        $students = Students::where('id', '=', "$search")
        ->get();
        //dd($programs);
        //dd(response()->json($programs));
        return response()->json($students);
    }

    public function searchEmployees(Request $request)
    {
        $search = $request->input('search');
       
        $employees = Employees::whereRaw("CONCAT_WS(' ', first_name, second_name, last_name, second_last_name) LIKE ?", ["%$search%"])
        ->orWhere('first_name', 'LIKE', "%$search%")
        ->orWhere('second_name', 'LIKE', "%{$search}%")
        ->orWhere('last_name', 'LIKE', "%{$search}%")
        ->orWhere('second_last_name', 'LIKE', "%{$search}%")
        ->get();
        //dd($programs);
        //dd(response()->json($programs));
        return response()->json($employees);
    }

    public function searchEmployeesId(Request $request)
    {
        $search = $request->input('search');
       
        $employees = Employees::where('id', '=', "$search")
        ->get();
        //dd($programs);
        //dd(response()->json($programs));
        return response()->json($employees);
    }

    public function destroy(Certificate $certificate){

        $certificate->delete();

        return back();

    }
}
