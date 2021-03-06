<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MultiImageController;
use App\Http\Controllers\Controller;
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
Route::get('/home', function () {
    echo 'This is Home page';
});
Route::get('/about', function () {
    return view('welcome');
});
Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        $users = User::all();
        return view('dashboard', compact('users'));
    })
    ->name('dashboard');
// Category Controller
Route::get('/category/all', [CategoryController::class, 'Allcategory'])->name('category');
Route::post('/category/add', [CategoryController::class, 'addcategory'])->name('storecategory');
Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'Update']);
Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('/category/pdelete/{id}', [CategoryController::class, 'Pdelete']);

// /////////////////////////////////1
//  Brand Cont
Route::get('/brand/all', [BrandController::class, 'Allbrand'])
    ->name('brand');
Route::post('/brand/add', [BrandController::class, 'addbrand'])
    ->name('storebrand');
Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'Update']);
Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);

// Multi Image
Route::get('/multi/image', [BrandController::class, 'multipic'])
    ->name('Multipic');
Route::post('/multi/add', [BrandController::class, 'stormulti'])
    ->name('StorMulti');

Route::get('/contact', [ContactController::class, 'index']);
