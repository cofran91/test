<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/list', [App\Http\Controllers\ShipmentController::class, 'list'])->name('list');
Route::get('/envio', [App\Http\Controllers\ShipmentController::class, 'send'])->name('send');
Route::post('/envio', [App\Http\Controllers\ShipmentController::class, 'shipment'])->name('shipment');
Route::get('/estatus/{id}', [App\Http\Controllers\ShipmentController::class, 'status'])->name('status');


