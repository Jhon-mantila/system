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

        //dd($certificates);
        return view('certificates-courses.index',[
            'certificates' => $certificates
        ]);
    }
}
