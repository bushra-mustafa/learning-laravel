<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------\
------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get ('/home', function () {
    echo "This is Home page" ;
});
Route::get('/about', function () {
    return view('welcome' );
});
Route::middleware(['auth:sanctum', 'verified'])
->get('/dashboard', function () {
    $users=User::all();
    return view('dashboard' , compact('users'));

})->name('dashboard');
// Category Controller

Route::get('/category/all',
[CategoryController::class, 'Allcategory'])
->name('category');
Route::get('/category/add',
[CategoryController::class, 'addcategory'])
->name('storecategory');

// /////////////////////////////////1
Route::get('/contact', [ContactController::class, 'index']);


