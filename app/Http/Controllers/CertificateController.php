<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    //
    public function index(Request $request){

        $search =  $request->search;

        $certificates = Certificate::with(['user', 'program', 'student', 'employee', 'company'])
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
}
