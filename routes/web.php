<?php

use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('teacherindex.index');
});
Route::get('/teachers', [TeacherController::class, 'index']);
// Route::resource('/teachers', [TeacherController::class]);
// Route::resource('/students', [StudentController::class]);
// Route::resource('/specializaion', [SpecializationController::class]);

// Route::resource('test', [TeacherController::class]);
