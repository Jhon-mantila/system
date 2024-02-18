<?php

namespace App\Http\Controllers;

use App\Models\PdfAttachments;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Storage;

class PdfAttachmentsController extends Controller
{
    //
    public function index(Request $request){

        $search =  $request->search;
        
        $attachments = PdfAttachments::with(['user', 'student'])
                ->whereHas('student', function ($query) use ($search) {
                    $query->where('first_name', 'LIKE', "%{$search}%")
                          ->orWhere('second_name', 'LIKE', "%{$search}%")
                          ->orWhere('last_name', 'LIKE', "%{$search}%")
                          ->orWhere('second_last_name', 'LIKE', "%{$search}%")
                          ->orWhere('document', 'LIKE', "%{$search}%");
                })       
                ->latest()->paginate();
        
        //dd($attachments);
        return view('pdf-attachments.index',[
            'attachments' => $attachments,
        ]);
    }

    public function create(PdfAttachments $pdf_attachment){

        return view('pdf-attachments.create',[
            'pdf_attachment' => $pdf_attachment,
        ]);
    }

    public function store(Request $request){
         

        $request->validate([
             'student_id' => 'required',
             'attachments' => [
                'required',
                'file', // Asegura que sea un archivo
                'mimes:pdf', // Asegura que sea un archivo PDF
                'max:1048', // Tamaño máximo en kilobytes (1 MB en este ejemplo)
            ],
 
         ],[
             'student_id.required' => 'El estudiante es requerido',
             'attachments.required' => 'El archivo PDF es requerido',
             'attachments.file' => 'El archivo debe ser un archivo',
             'attachments.mimes' => 'El archivo debe ser de tipo PDF.',
             'attachments.max' => 'El archivo no debe exceder 1 megabytes.',
 
         ]);
 
         if(empty($request->attachments)){
            $path = null;
        }else{            
            $path = $request->file('attachments')->store('attachments');  
        }
         //dd($request);
         $attachment = $request->user()->pdfAttachments()->create([
             'id' => (String) Uuid::uuid4(),
             'name' => $request->name,
             'student_id' => $request->student_id,
             'attachments' => $path,
         ]);
 
         return redirect()->route('pdf-attachments.edit', $attachment);
    }
    public function edit(PdfAttachments $pdf_attachment){

        //dd($pdf_attachment);
        return view('pdf-attachments.edit',[
            'pdf_attachment' => $pdf_attachment,
        ]);
    }

    public function update(Request $request, PdfAttachments $pdf_attachment){
        //dd($request->attachments);
        //dd($pdf_attachment->attachments);

        $path = '';

        $request->validate([
            'student_id' => 'required',
            'attachments' => [
               'required',
               'file', // Asegura que sea un archivo
               'mimes:pdf', // Asegura que sea un archivo PDF
               'max:1048', // Tamaño máximo en kilobytes (1 MB en este ejemplo)
           ],

        ],[
            'student_id.required' => 'El estudiante es requerido',
            'attachments.required' => 'El archivo PDF es requerido',
            'attachments.file' => 'El archivo debe ser un archivo',
            'attachments.mimes' => 'El archivo debe ser de tipo PDF.',
            'attachments.max' => 'El archivo no debe exceder 1 megabytes.',

        ]);

        if(empty($request->attachments)){
            $path = $pdf_attachment->attachments;
        }else{
            if(!empty($pdf_attachment->attachments)){
                Storage::delete($pdf_attachment->attachments);
            }
            
            $path = $request->file('attachments')->store('attachments');  
        }
        //dd($path);
        
        $pdf_attachment->update([
            'name' => $request->name,
            'student_id' => $request->student_id,
            'attachments' => $path,
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        
        return redirect()->route('pdf-attachments.edit', $pdf_attachment);
    }

    public function destroy(PdfAttachments $pdf_attachment){

        //dd($employee->signature);
        Storage::delete($pdf_attachment->attachments);
        $pdf_attachment->delete();

        return back();
    }
}
