<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SearchesController;
use App\Http\Controllers\CatalogosController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\FinanceController;

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
    return view('auth.login');
});

//searches
Route::get('/get_user/{id}', [SearchesController::class,'search_user'])->name('search_user');
Route::get('/get_vehiculo/{id}', [SearchesController::class,'search_vehiculo'])->name('search_vehiculo');
Route::get('/get_cp/{cp}', [SearchesController::class,'search_cp'])->name('search_cp');
Route::get('/get_servicios/{id}', [SearchesController::class,'search_service'])->name('search_service');
Route::get('/get_servicio_vehiculos/{id_servicio}', [SearchesController::class,'search_service_vehiculo'])->name('search_service_vehiculo');

//home
Route::get('/Home', [HomeController::class,'view_home'])->name('home');

//users
Route::get('/Users', [UsersController::class,'view_users'])->name('users');
Route::post('/guardar_user',[UsersController::class,'agregar_users'])->name('agregar_users');
Route::post('/Actualizar_user',[UsersController::class,'actualizar_users'])->name('actualizar_users');
Route::delete('/Eliminar_user',[UsersController::class,'eliminar_user'])->name('eliminar_user');

//catalogos
Route::get('/Catalogos',[CatalogosController::class,'view_catalogos'])->name('catalogos');
Route::post('/guardar_vehiculo',[CatalogosController::class,'agregar_vehiculo'])->name('agregar_vehiculo');
Route::post('/Actualizar_vehiculo',[CatalogosController::class,'actualizar_vehiculo'])->name('actualizar_vehiculo');
Route::delete('/Eliminar_vehiculo',[CatalogosController::class,'eliminar_vehiculo'])->name('eliminar_vehiculo');

//services
Route::get('/Servicios',[ServicesController::class,'view_services'])->name('services');
Route::post('/guardar_servicio',[ServicesController::class,'agregar_service'])->name('agregar_service');
Route::post('/Actualizar_servicio',[ServicesController::class,'actualizar_service'])->name('actualizar_service');
Route::delete('/Eliminar_servicio',[ServicesController::class,'eliminar_service'])->name('eliminar_service');
Route::get('/PDF_servicio/{id}',[ServicesController::class,'pdf_service'])->name('pdf_service');
Route::get('/envio',[ServicesController::class,'envio'])->name('envio');

//finance
Route::get('/Finanzas',[FinanceController::class,'view_finance'])->name('finance');
Route::post('/dar_alta_finanza',[FinanceController::class,'dar_alta_finanza'])->name('dar_alta_finanza');
Route::post('/Agregar_cantidad',[FinanceController::class,'agregar_presupuesto'])->name('agregar_presupuesto');
Route::delete('/Eliminar_finance',[FinanceController::class,'eliminar_finance'])->name('eliminar_finance');
Route::get('/PDF_finance/{id}',[FinanceController::class,'pdf_finance'])->name('pdf_finance');