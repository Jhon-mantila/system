<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    //
    public function index(Request $request){

        $search =  $request->search;

        $employees = Employees::where('first_name', 'LIKE', "%{$search}%")
        ->orWhere('second_name', 'LIKE', "%{$search}%")
        ->orWhere('last_name', 'LIKE', "%{$search}%")
        ->orWhere('second_last_name', 'LIKE', "%{$search}%")
        ->latest()->paginate();

        return view('employees.index',[
            'employees' => $employees
        ]);
    }
}
