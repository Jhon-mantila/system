<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index(){
        $data = array();
        
        $jsonData = json_encode($data);

        $cant_students = DB::table('students')->where('active', 1)->count();
        $cantidad_certificados = DB::table('certificates')->where('accredited', 1)->count();
        $anos_certificates = DB::table('certificates')
                                    ->select(DB::raw('YEAR(date_start) as year'))
                                    ->where('type_certificate', '=', 'c')
                                    ->groupBy('year')
                                    ->orderBy('year')->get();
        // echo '<pre>';
        // echo print_r($anos_certificates, true);
        //  foreach($anos_certificates as $value){
        //     echo $value->year;
        // }
        // dd($anos_certificates);

        $data['students'] = $cant_students;
        $data['certificate'] = $cantidad_certificados;
        $data['year'] = $anos_certificates;

        //dd($data);

        return view('dashboard', compact('data'));
    }

    public function certificateForYear(Request $request){

        $search = $request->input('search');
        //dd($search);
        
        if(empty($search)){
            $search = 1986;
        }

        $data = array();
        $cantidad_certificados = DB::select("SELECT MONTHNAMES.month_name AS mes, IFNULL(COUNT(c.date_start), 0) AS cantidad_mes
        FROM (
            SELECT 1 AS month_num, 'Enero' AS month_name UNION ALL
            SELECT 2, 'Febrero' UNION ALL
            SELECT 3, 'Marzo' UNION ALL
            SELECT 4, 'Abril' UNION ALL
            SELECT 5, 'Mayo' UNION ALL
            SELECT 6, 'Junio' UNION ALL
            SELECT 7, 'Julio' UNION ALL
            SELECT 8, 'Agosto' UNION ALL
            SELECT 9, 'Septiembre' UNION ALL
            SELECT 10, 'Octubre' UNION ALL
            SELECT 11, 'Noviembre' UNION ALL
            SELECT 12, 'Diciembre'
        ) AS MONTHNAMES
        LEFT JOIN certificates c ON MONTH(c.date_start) = MONTHNAMES.month_num
            AND YEAR(c.date_start) = ?
            AND c.type_certificate = ?
        GROUP BY MONTHNAMES.month_num, MONTHNAMES.month_name
        ORDER BY MONTHNAMES.month_num", [$search,"c"]);
        //echo "<pre>";
        //echo print_r($cantidad_certificados, true);
        
        foreach($cantidad_certificados as $value){
            $data['mes'][] = $value->mes;
            $data['cantidad'][] = $value->cantidad_mes;
            //echo $value->mes;
        }

        //echo print_r($data, true);
        //dd($cantidad_certificados);
        return response()->json($data);
    }

    public function certificatesActivesInactives(){
        
        $result = array();
        $cantidad = 0;
        $data = DB::select("SELECT 'ACTIVOS', COUNT(*) AS CANTIDAD
        FROM certificates c
        WHERE c.date_end > DATE(NOW())
        UNION
        SELECT 'INACTIVOS', COUNT(*) AS CANTIDAD
        FROM certificates c
        WHERE c.date_end < DATE(NOW())");

        //echo "<pre>";
        //echo print_r($data, true);
        foreach($data as $value){
            $cantidad += $value->CANTIDAD;
        }
        //echo $cantidad;
        
        foreach($data as $value){
            //$result['mes'][] = $value->mes;
            
            $result[] = number_format(($value->CANTIDAD/$cantidad)*100, 2, '.', '');
            
        }

        //echo print_r($result, true);
        return response()->json($result);
    }
}
