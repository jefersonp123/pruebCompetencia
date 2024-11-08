<?php

use App\Exports\AutoresExport;
use App\Exports\LibrosExport;
use App\Extensions\HttpCurls;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\LibroController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('me', [AuthController::class, 'me']);
});


Route::group([

    'middleware' => 'api',
    'prefix' => 'autor'

], function ($router) {
    Route::post('create', [AutorController::class, 'create']);
    Route::post('update', [AutorController::class, 'edit']);
    Route::post('delete', [AutorController::class, 'destroy']);
    Route::get('list/{id?}', [AutorController::class, 'show']);
    Route::get('exportar', [AutorController::class, 'exportData']);
});


Route::group([

    'middleware' => 'api',
    'prefix' => 'libro'

], function ($router) {
    Route::post('create', [LibroController::class, 'create']);
    Route::post('update', [LibroController::class, 'edit']);
    Route::post('delete', [LibroController::class, 'destroy']);
    Route::get('list/{name?}', [LibroController::class, 'show']);
    Route::get('exportar', [LibroController::class, 'exportData']);
});
