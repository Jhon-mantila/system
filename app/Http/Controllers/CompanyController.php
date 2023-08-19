<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class CompanyController extends Controller
{
    //
    public function index(){

        $companies = Company::all();

        return view('companies.index',[
            'companies' => $companies
        ]);
    }

    public function edit(Company $company){

        return view('companies.edit', [
            'company' => $company
        ]);
    }

    public function update(Request $request, Company $company){
        //dd($request->signature);
        //dd($employee->signature);

        $path = '';

        $request->validate([
            'name' => 'required',
            'nit'  => 'required|unique:companies,nit,' . $company->id,
            'phone'  => 'required',
            'logo' => [
                'image', // Asegura que sea una imagen
                'mimes:png,jpeg', // Asegura que sea un archivo PNG o JPEG
                File::image()
                ->max('2mb'), // Tamaño máximo en kilobytes (1 MB en este ejemplo)
            ],
        ],[
            'name.required' => 'El nombre es requerido',
            'nit.required'  => 'El Nit es obligatorio',
            'document.unique'    => 'El documento debe ser único',
            'phone.required'  => 'El Teléfono es requerido',
            'logo.image'  => 'El archivo debe ser una imagen',            
            'logo.mimes'  => 'La imagen debe ser de tipo JPEG o PNG.',
            'logo.max'  => 'La imagen no debe exceder los 2 megabytes.',
        ]);

        if(empty($request->logo)){
            $path = $company->logo;
        }else{
            if(!empty($company->logo)){
                Storage::delete($company->logo);
            }
            
            $path = $request->file('logo')->store('signature');  
        }

        $company->update([
            'name' => $request->name,
            'nit' => $request->nit,
            'web' => $request->web,
            'direction' => $request->direction,
            'city' => $request->city,
            'mobile' => $request->mobile,
            'phone' => $request->phone,
            'agent' => $request->agent,
            'logo' => $path,
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        
        return redirect()->route('companies.edit', $company);
    }
}
