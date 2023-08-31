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

    public function certificateForYear(){

        //$search = $request->input('search');
        //dd($search);
        $data = array();
        $cantidad_certificados = DB::select('SELECT MONTHNAME(date_start) as mes, COUNT(MONTH(date_start)) as cantidad_mes
        FROM certificates c 
        INNER JOIN programs p ON p.id = c.program_id
        WHERE type_certificate = ? AND YEAR(date_start) = ?
        GROUP by YEAR(c.date_start), MONTH(date_start) 
        ORDER by date_start', ["c", 1986]);
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
