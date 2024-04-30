<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BirthdayController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);

    //rutas que funcionan mientras exista el usuarios
    Route::apiResource('/documents', DocumentController::class);
    Route::apiResource('/birthdays', BirthdayController::class);
    Route::apiResource('/reports', ReportController::class);

});

Route::apiResource('/users', UserController::class);


//rutas para crear y registrar usuarios para acceder a la aplicacion
Route::post('/signup',[AuthController::class, 'signup']);
Route::post('/login',[AuthController::class, 'login']);


//rutas que funcionan en el home

//obtiene todos las noticias destacadas, aunque trae todas las noticas existentes
Route::get('/getnewsfeatured', [ReportController::class, 'getNewsFeatured']);


//obtiene las noticias con una paginacion de a 3
Route::get('/getnews', [ReportController::class, 'getNews']);

//obtiene la noticia seleccionada
Route::get('/getreports/{report}', [ReportController::class, 'showNews']);


//obtiene los cumpleaños y el mes
Route::get('/getbirthdays', [BirthdayController::class, 'getBirthdayMonth']);

//obtiene todos los documentos
Route::get('/getdocuments', [DocumentController::class, 'index']);

//descarga de archivos
Route::get("/download/{archivo}", [DocumentController::class, 'download']);
