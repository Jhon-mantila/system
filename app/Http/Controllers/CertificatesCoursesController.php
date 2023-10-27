<?php

namespace App\Http\Controllers;

use App\Models\CertificatesCourses;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employees;
use App\Models\Course;
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
                          ->orWhere('second_last_name', 'LIKE', "%{$search}%");
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
        
        $typeCertificate = $this->dropdownService->getTypeCertificate();

        $certificate = CertificatesCourses::with(['user', 'course', 'student', 'employee', 'company'])
        ->get()
        ->where('id', '=', $certificates_course->id);
        //dd($certificate);
        return view('certificates-courses.show', [
            'certificate' => $certificate,
            'typeCertificate' => $typeCertificate,
        ]);
    }

    public function create(CertificatesCourses $certificate){

        $typeCertificate = $this->dropdownService->getTypeCertificate();

        return view('certificates-courses.create',[
            'certificate' => $certificate,
            'typeCertificate' => $typeCertificate,
        ]);
    }

    public function store(Request $request){
        
        $request->validate([
             'course_id' => 'required',
             'student_id' => 'required',
             'employee_id' => 'required',
             'date_start' => 'required',
             'date_end' => 'required',
             'type_certificate' => 'required'
 
         ],[
             'course_id.required' => 'El curso es requerido',
             'student_id.required' => 'El estudiante es requerido',
             'employee_id.required' => 'El empleado es requerido',
             'date_start.required' => 'La fecha inicial es requerida',
             'date_end.required' => 'La fecha final es requerida',
             'type_certificate.required' => 'Es requerido',
 
         ]);
 
         $company = Company::all();
         //echo print_r($company, true);
         //dd($company[0]['id']);
         //dd($request);
         $certificate = $request->user()->certificatesCourses()->create([
             'id' => (String) Uuid::uuid4(),
             'course_id' => $request->course_id,
             'student_id' => $request->student_id,
             'employee_id' => $request->employee_id,
             'date_start' => $request->date_start,
             'date_end' => $request->date_end,
             'type_certificate' => $request->type_certificate,
             'company_id' => $company[0]['id'],
             'module' => 'curso',
             'accredited' => $request->accredited,
             'notified' => $request->notified,
         ]);
 
         return redirect()->route('certificates-courses.edit', $certificate);
    }

    public function edit(CertificatesCourses $certificates_course){

        $typeCertificate = $this->dropdownService->getTypeCertificate();

        return view('certificates-courses.edit', [
            'certificate' => $certificates_course,
            'typeCertificate' => $typeCertificate,
        ]);
    }

    public function update(Request $request, CertificatesCourses $certificates_course){

        $request->validate([
            'course_id' => 'required',
            'student_id' => 'required',
            'employee_id' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',

        ],[
            'course_id.required' => 'El curso es requerido',
            'student_id.required' => 'El estudiante es requerido',
            'employee_id.required' => 'El empleado es requerido',
            'date_start.required' => 'La fecha inicial es requerida',
            'date_end.required' => 'La fecha final es requerida',

        ]);
        //dd($request->type_certificate);
        $certificates_course->update([
            'course_id' => $request->course_id,
            'student_id' => $request->student_id,
            'employee_id' => $request->employee_id,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'type_certificate' => $request->type_certificate,
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
}
