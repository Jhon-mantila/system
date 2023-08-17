<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //
    public function index(Request $request){

        $companies = Company::all();

        return view('companies.index',[
            'companies' => $companies
        ]);
    }
}
