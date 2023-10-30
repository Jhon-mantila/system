<?php

use App\Http\Controllers\StudentsController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/students-api', [StudentsController::class, 'apiStudents']);
Route::get('/search-programs', [CertificateController::class, 'searchPrograms']);
Route::get('/search-programs-id', [CertificateController::class, 'searchProgramsId']);
Route::get('/search-students', [CertificateController::class, 'searchStudents']);
Route::get('/search-students-id', [CertificateController::class, 'searchStudentsId']);
Route::get('/search-employees', [CertificateController::class, 'searchEmployees']);
Route::get('/search-employees-id', [CertificateController::class, 'searchEmployeesId']);

Route::get('/quantity-certificates', [DashboardController::class, 'certificateForYear']);
Route::get('/certificates-actives', [DashboardController::class, 'certificatesActivesInactives']);