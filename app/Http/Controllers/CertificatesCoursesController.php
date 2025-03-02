<?php

namespace App\Http\Controllers;

use App\Models\CertificatesCourses;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employees;
use App\Models\Course;
use App\Models\Programs;
use App\Models\Students;
use Ramsey\Uuid\Uuid;
use App\Services\DropdownService;

class CertificatesCoursesController extends Controller
{
    //
    protected $dropdownService;
    
    public function __construct(DropdownService $dropdownService)
    {
        $this->dropdownService = $dropdownService;
    }

    public function index(Request $request){

        $search =  $request->search;
        
        $certificates = CertificatesCourses::with(['user', 'course', 'student'])
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
        return view('certificates-courses.index',[
            'certificates' => $certificates,
            'typeCertificate' => $typeCertificate
        ]);
    }

    public function show(CertificatesCourses $certificates_course){
       
        //dd($id);
        $typeCertificate = $this->dropdownService->getTypeCertificate();
        $accreditedOptions = $this->dropdownService->getAccredited();
        $typeCode = $this->dropdownService->getCode();

        $certificate = CertificatesCourses::with(['user', 'course', 'student', 'employee', 'company'])
        ->get()
        ->where('id', $certificates_course->id);

        foreach($certificate as $valor){
            $programs = Programs::where('id', '=', "$valor->title")->get();
        }
        //dd($certificate);
        return view('certificates-courses.show', [
            'certificate' => $certificate,
            'typeCertificate' => $typeCertificate,
            'accreditedOptions' => $accreditedOptions,
            'typeCode' => $typeCode,
            'titulo' => $programs,
        ]);
    }

    public function create(CertificatesCourses $certificate){

        $typeCertificate = $this->dropdownService->getTypeCertificate();
        $accreditedOptions = $this->dropdownService->getAccredited();
        $typeCode = $this->dropdownService->getCode();

        return view('certificates-courses.create',[
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
        }else if($request->type_certificate == 't'){
            $required_certificate = '';
            $required = 'required';
        }else if($request->type_certificate == 'a'){
            $required = 'required';
            $required_certificate = '';
        }

        //Agregar 1 para el siguiente
        $certificate = CertificatesCourses::max('code');   

        $request->validate([
             'course_id' => 'required',
             'student_id' => 'required',
             'employee_id' => 'required',
             'date_start' => $required,
             'date_end' => $required,
             'date_certificate' => $required_certificate,
             'type_certificate' => 'required'
 
         ],[
             'course_id.required' => 'El curso es requerido',
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
         $certificate = $request->user()->certificatesCourses()->create([
             'id' => (String) Uuid::uuid4(),
             'code' => $certificate + 1,
             'course_id' => $request->course_id,
             'student_id' => $request->student_id,
             'employee_id' => $request->employee_id,
             'date_start' => $request->date_start,
             'date_end' => $request->date_end,
             'date_certificate' => $request->date_certificate,
             'type_certificate' => $request->type_certificate,
             'company_id' => $company[0]['id'],
             'module' => 'curso',
             'title' => $request->title,
             'type_code' => $request->type_code,
             'references' => $request->references,
             'process' => $request->process,
             'accredited' => $request->accredited,
             'notified' => $request->notified,
         ]);
 
         return redirect()->route('certificates-courses.edit', $certificate);
    }

    public function edit(CertificatesCourses $certificates_course){

        $typeCertificate = $this->dropdownService->getTypeCertificate();
        $accreditedOptions = $this->dropdownService->getAccredited();
        $typeCode = $this->dropdownService->getCode();

        return view('certificates-courses.edit', [
            'certificate' => $certificates_course,
            'typeCertificate' => $typeCertificate,
            'accreditedOptions' => $accreditedOptions,
            'typeCode' => $typeCode,
        ]);
    }

    public function update(Request $request, CertificatesCourses $certificates_course){
            if($request->type_certificate == 'c'){
                $required = 'required';
                $required_certificate = '';
            }else if($request->type_certificate == 'cm'){
                $required_certificate = 'required';
                $required = '';
            }else if($request->type_certificate == 't'){
                $required_certificate = '';
                $required = 'required';
            }else if($request->type_certificate == 'a'){
                $required = 'required';
                $required_certificate = '';
            }
        $request->validate([
            'course_id' => 'required',
            'student_id' => 'required',
            'employee_id' => 'required',
            'date_start' => $required,
            'date_end' => $required,
            'date_certificate' => $required_certificate,

        ],[
            'course_id.required' => 'El curso es requerido',
            'student_id.required' => 'El estudiante es requerido',
            'employee_id.required' => 'El empleado es requerido',
            'date_start.required' => 'La fecha inicial es requerida',
            'date_end.required' => 'La fecha final es requerida',
            'date_certificate.required' => 'La fecha del certificado es requerida',

        ]);
        //dd($request->type_certificate);
        $certificates_course->update([
            'course_id' => $request->course_id,
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
       
        return redirect()->route('certificates-courses.edit', $certificates_course);
    }


    public function searchCourses(Request $request)
    {
        $search = $request->input('search');
       
        $courses = Course::where('name', 'LIKE', "%$search%")->get();
        //dd($courses);
        //dd(response()->json($courses));
        return response()->json($courses);
    }

    public function searchCoursesId(Request $request)
    {
        $search = $request->input('search');

        $courses = Course::where('id', '=', "$search")->get();
        //dd($courses);
        //dd(response()->json($courses));
        return response()->json($courses);
    }

    public function duplicate(CertificatesCourses $certificates_course)
    {
        // Obtiene el certificado
        //$certificates_course = CertificatesCourses::find($certificates_course->id);
        //dd($certificates_course);
        // // Crea una copia del certificado
        $certificate_duplicate = $certificates_course->replicate();
        $certificate_max = CertificatesCourses::max('code');
        // Asigna un ID UUID al registro duplicado
        //$certificate_duplicate->assignUuid(Uuid::uuid4());
        $certificate_duplicate->id = Uuid::uuid4()->toString();
        $certificate_duplicate->code = $certificate_max + 1;
        // Guarda el registro duplicado
        //dd($certificate_duplicate);
        $certificate_duplicate->save();
        // Redirige a la vista de listado de certificados
        return back();
        // //return redirect()->route('certificates.index');
    }
    
    public function destroy(CertificatesCourses $certificates_course){
        //dd($certificates_course);
        $certificates_course->delete();

        return back();

    }
}
