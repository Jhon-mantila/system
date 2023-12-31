<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use App\Services\DropdownService;

class EmployeesController extends Controller
{
    //
    protected $dropdownService;
    
    public function __construct(DropdownService $dropdownService)
    {
        $this->dropdownService = $dropdownService;
    }

    public function index(Request $request){

        $search =  $request->search;

        $employees = Employees::where('first_name', 'LIKE', "%{$search}%")
        ->orWhere('second_name', 'LIKE', "%{$search}%")
        ->orWhere('last_name', 'LIKE', "%{$search}%")
        ->orWhere('second_last_name', 'LIKE', "%{$search}%")
        ->orWhere('document', 'LIKE', "%{$search}%")
        ->latest()->paginate();

        $typeEmployee = $this->dropdownService->getTypeEmployee();

        return view('employees.index',[
            'employees' => $employees,
            'typeEmployee' => $typeEmployee
        ]);
    }

    public function show(Employees $employee){

        $activeOptions = $this->dropdownService->getActive();
        $typeDocument = $this->dropdownService->getTypeDocumento();
        $typeEmployee = $this->dropdownService->getTypeEmployee();

        $employee = Employees::with('user')->get()->where('id', '=', $employee->id);
        //$url = Storage::url('signature/Apfdv3uBffxB9lnrcijtFnfJ6XEOEZj3RkOOzmcP.png');
        //dd($url);
        return view('employees.show', [
            'employee' => $employee,
            'activeOptions' => $activeOptions,
            'typeDocument' => $typeDocument,
            'typeEmployee' => $typeEmployee,
        ]);
    }

    public function create(Employees $employee){

        $activeOptions = $this->dropdownService->getActive();
        $typeDocument = $this->dropdownService->getTypeDocumento();
        $typeEmployee = $this->dropdownService->getTypeEmployee();

        return view('employees.create',[
            'employee' => $employee,
            'activeOptions' => $activeOptions,
            'typeDocument' => $typeDocument,
            'typeEmployee' => $typeEmployee,
        ]);
    }

    public function store(Request $request){
        
        $request->validate([
            'first_name' => 'required',
            'document'  => 'required|unique:employees,document',
            'last_name'  => 'required',
            'mobile'  => 'required',
            'email'  => 'required',
            'signature' => [
                'image', // Asegura que sea una imagen
                'mimes:png,jpeg', // Asegura que sea un archivo PNG o JPEG
                File::image()
                ->max('2mb'), // Tamaño máximo en kilobytes (1 MB en este ejemplo)
            ],
        ],[
            'first_name.required' => 'El primer nombre es requerido',
            'document.required'  => 'El documento es obligatorio',
            'document.unique'    => 'El documento ya existe',
            'last_name.required'  => 'El primer apellido es requerido',
            'mobile.required'  => 'El celular es requerido',
            'email.required'  => 'El correo electronico es requerido',
            'signature.image'  => 'El archivo debe ser una imagen',            
            'signature.mimes'  => 'La imagen debe s er de tipoJPEG o PNG.',
            'signature.max'  => 'La imagen no debe exceder los 2 megabytes.',
            
        ]);

        if(empty($request->signature)){
            $path = null;
        }else{            
            $path = $request->file('signature')->store('signature');  
        }
        
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
            'signature' => $path,
            'type_employee' => $request->type_employee,
            'active' => $request->active
        ]);
       
        return redirect()->route('employees.edit', $employee);

    }
    public function edit(Employees $employee){

        $activeOptions = $this->dropdownService->getActive();
        $typeDocument = $this->dropdownService->getTypeDocumento();
        $typeEmployee = $this->dropdownService->getTypeEmployee();

        return view('employees.edit', [
            'employee' => $employee,
            'activeOptions' => $activeOptions,
            'typeDocument' => $typeDocument,
            'typeEmployee' => $typeEmployee,
        ]);
    }

    public function update(Request $request, Employees $employee){
        //dd($request->signature);
        //dd($employee->signature);

        $path = '';

        $request->validate([
            'first_name' => 'required',
            'document'  => 'required|unique:employees,document,' . $employee->id,
            'last_name'  => 'required',
            'mobile'  => 'required',
            'email'  => 'required',
            'signature' => [
                'image', // Asegura que sea una imagen
                'mimes:png,jpeg', // Asegura que sea un archivo PNG o JPEG
                File::image()
                ->max('2mb'), // Tamaño máximo en kilobytes (1 MB en este ejemplo)
            ],
        ],[
            'first_name.required' => 'El primer nombre es requerido',
            'document.required'  => 'El documento es obligatorio',
            'document.unique'    => 'El documento debe ser único',
            'last_name.required'  => 'El primer apellido es requerido',
            'mobile.required'  => 'El celular es requerido',
            'email.required'  => 'El correo electronico es requerido',
            'signature.image'  => 'El archivo debe ser una imagen',            
            'signature.mimes'  => 'La imagen debe ser de tipo JPEG o PNG.',
            'signature.max'  => 'La imagen no debe exceder los 2 megabytes.',
        ]);

        if(empty($request->signature)){
            $path = $employee->signature;
        }else{
            if(!empty($employee->signature)){
                Storage::delete($employee->signature);
            }
            
            $path = $request->file('signature')->store('signature');  
        }
        //dd($path);
        
        $employee->update([
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
            'signature' => $path,
            'type_employee' => $request->type_employee,
            'active' => $request->active,
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        
        return redirect()->route('employees.edit', $employee);
    }

    public function destroy(Employees $employee){

        //dd($employee->signature);
        Storage::delete($employee->signature);
        $employee->delete();

        return back();
    }
}
