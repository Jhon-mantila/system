<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\CertificatesCourses;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Services\DropdownService;
class HomeController extends Controller
{
    //

    protected $dropdownService;
    
    public function __construct(DropdownService $dropdownService)
    {
        $this->dropdownService = $dropdownService;
    }

    public function index(Request $request){

        $typeCertificate = $this->dropdownService->getTypeCertificate();

        $search =  $request->search;

        $data = DB::select(
            "SELECT 
            co.name AS 'nombre_empresa',
            co.nit,co.web,
            co.direction,co.city AS 'ciudad_empresa',
            co.mobile,
            co.phone,co.logo,
            s.first_name AS 'nombre_estudiante',
            s.second_name AS 'segundo_nombre_estudiante',
            s.last_name AS 'primer_apellido_estudiante',
            s.second_last_name AS 'segundo_apellido_estudiante',
            s.city AS 'ciudad_estudiante',
            e.first_name AS 'nombre_empleado',
            e.second_name AS 'segundo_nombre_empleado', 
            e.last_name AS 'primer_apellido_empleado', 
            e.second_last_name AS 'segundo_apellido_empleado', 
            e.signature,
            c.code,c.name AS 'nombre_programa',c.hours,
            cc.date_start AS 'fecha_inicio', 
            cc.date_end AS 'fecha_fin', 
            cc.type_certificate AS 'tipo_certificado', 
            cc.module, 
            cc.updated_at, 
            cc.id AS 'id_certificado', 
            cc.file
                        FROM certificates cc 
                        INNER JOIN programs c ON c.id = cc.program_id 
                        INNER JOIN students s ON s.id = cc.student_id
                        INNER JOIN employees e ON e.id = cc.employee_id
                        INNER JOIN companies co ON co.id = cc.company_id
                        WHERE s.document = ? AND s.active = 1
                        UNION
            SELECT  
            co.name AS 'nombre_empresa',
            co.nit,co.web,co.direction,
            co.city AS 'ciudad_empresa',
            co.mobile,co.phone,co.logo,
            s.first_name AS 'nombre_estudiante',
            s.second_name AS 'segundo_nombre_estudiante',
            s.last_name AS 'primer_apellido_estudiante',
            s.second_last_name AS 'segundo_apellido_estudiante',
            s.city AS 'ciudad_estudiante',
            e.first_name AS 'nombre_empleado',
            e.second_name AS 'segundo_nombre_empleado', 
            e.last_name AS 'primer_apellido_empleado', 
            e.second_last_name AS 'segundo_apellido_empleado', 
            e.signature,
            c.code,c.name AS 'nombre_programa',c.hours,
            cc.date_start AS 'fecha_inicio', 
            cc.date_end AS 'fecha_fin', 
            cc.type_certificate AS 'tipo_certificado', 
            cc.module, cc.updated_at, 
            cc.id AS 'id_certificado', 
            cc.file
                        FROM certificates_courses cc 
                        INNER JOIN courses c ON c.id = cc.course_id
                        INNER JOIN students s ON s.id = cc.student_id
                        INNER JOIN employees e ON e.id = cc.employee_id
                        INNER JOIN companies co ON co.id = cc.company_id
            WHERE s.document = ? AND s.active = 1 
            
            UNION
            
            SELECT
            'nombre_empresa',
            'nit',
            'web',
            'direction',
            'ciudad_empresa',
            'mobile',
            'phone',
            'logo',
            s.first_name AS 'nombre_estudiante',
            s.second_name AS 'segundo_nombre_estudiante',
            s.last_name AS 'primer_apellido_estudiante',
            s.second_last_name AS 'segundo_apellido_estudiante',
            s.city AS 'ciudad_estudiante',
            'nombre_empleado',
            'segundo_nombre_empleado', 
            'primer_apellido_empleado', 
            'segundo_apellido_empleado', 
            'signature',
            '',
            pa.name AS 'nombre_programa',
            'hours',
            '', 
            '', 
            'a', 
            '', 
            pa.updated_at, 
            pa.attachments AS 'id_certificado',
            NULL
            FROM pdf_attachments pa 
            INNER JOIN students s ON s.id = pa.student_id
            WHERE s.document = ?
            ORDER BY updated_at DESC", [$search,$search,$search]);

        if(empty($data)){
            $data = DB::select(
                "SELECT 
                s.first_name AS 'nombre_estudiante',
                s.second_name AS 'segundo_nombre_estudiante',
                s.last_name AS 'primer_apellido_estudiante',
                s.second_last_name AS 'segundo_apellido_estudiante',
                s.active AS activo
                FROM students s 
                WHERE s.document = ? AND s.active = 1", [$search]);
        }
        //dd($data);
        return view('welcome', [
            'data' => $data,
            'typeCertificate' => $typeCertificate,
        ]);
    }
}
