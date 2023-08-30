<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramsController;
use App\Http\Controllers\StudentsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//trabaja con todas las rutas de programas menos con la ruta show
//php artisan route:list
Route::resource('programs', ProgramsController::class)->middleware(['auth', 'verified']);
Route::resource('students', StudentsController::class)->middleware(['auth', 'verified']);
Route::resource('employees', EmployeesController::class)->middleware(['auth', 'verified']);
Route::resource('companies', CompanyController::class)->middleware(['auth', 'verified'])->except(['show','create','store','destroy']);
Route::resource('certificates', CertificateController::class)->middleware(['auth', 'verified']);
Route::resource('courses', CourseController::class)->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
