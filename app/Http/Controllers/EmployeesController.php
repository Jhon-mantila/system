<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Storage;

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

    public function show(Employees $employee){
        
        $employee = Employees::with('user')->get()->where('id', '=', $employee->id);
        //$url = Storage::url('signature/Apfdv3uBffxB9lnrcijtFnfJ6XEOEZj3RkOOzmcP.png');
        //dd($url);
        return view('employees.show', [
            'employee' => $employee
        ]);
    }

    public function create(Employees $employee){

        return view('employees.create',[
            'employee' => $employee
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

        $employee = $request->user()->employees()->create([
            'id' => (String) Uuid::uuid4(),
            'type_document' => $request->type_document,
            'document' => $request->document,
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'last_name' => $request->last_name,
            'second_last_name' => $request->second_last_name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'profession' => $request->profession,
            'specialty' => $request->specialty,
            'description' => $request->description,
            'signature' => $request->file('signature')->store('signature'),
            'type_employee' => $request->type_employee,
            'active' => $request->active
        ]);
       
        return redirect()->route('employees.edit', $employee);

    }
    public function edit(Employees $employee){

        return view('employees.edit', [
            'employee' => $employee
        ]);
    }
}
