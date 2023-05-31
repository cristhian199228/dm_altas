<?php

use App\Http\Controllers\Api\AtencionDescansoController;
use App\Http\Controllers\Api\AutenticacionController;
use App\Http\Controllers\Api\DescansoMedicoController;
use App\Http\Controllers\Api\UbigeoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EnfermedadController;

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
/* Route::get('/departamentosReniec', 'Api\DepartamentosController@departamentosReniec'); */
Route::get('/departamentosReniec', [UbigeoController::class, 'departamentosReniec']);
Route::get('/provinciasReniec', [UbigeoController::class, 'provinciasReniec']);
Route::get('/distritosReniec', [UbigeoController::class, 'distritosReniec']);
Route::post('/uploadDescansoMedico', [DescansoMedicoController::class, 'uploadDescansoMedico']);
Route::get('/showdm/{path}',  [DescansoMedicoController::class, 'show']);
Route::get('/fetchDocumentosRequeridos', [DescansoMedicoController::class, 'fetchDocumentosRequeridos']);
Route::post('/storeConsentimiento', [DescansoMedicoController::class, 'storeConsentimiento']);

Route::post('/loginLugarNacimiento', [AutenticacionController::class, 'loginLugarNacimiento']);

Route::apiResource('atencionDescanso', AtencionDescansoController::class);

Route::get('/enfermedades/search', [EnfermedadController::class, 'search']);
