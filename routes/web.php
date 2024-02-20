<?php

use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
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

//Route::get('/', function () {
   // return view('template_back.layout');
//});

//ROUTE BARU
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/auth', [LoginController::class, 'auth'])->name('auth');
Route::resource('buku', BukuController::class);
Route::get('/export_pdf_buku', [BukuController::class, 'export_pdf'])->name('export_pdf_buku');
Route::get('/export_pdf_excel', [BukuController::class, 'export_excel'])->name('export_excel_buku');
Route::get('/Buku', 'BukuController@index');