<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index(){
        $data = [
            'labels' => ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
            'data' => [10, 20, 15, 25, 30],
        ];

        $jsonData = json_encode($data);

        return view('dashboard', compact('jsonData'));
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
}
