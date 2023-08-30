<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
