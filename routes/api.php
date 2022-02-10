<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



 

//Route::post('/registro',[App\Http\Controllers\UserController::class,'register']);

//Route::post('/register',[App\Http\Controllers\UserController::class,'register']); //Registro

//Route::post('/login',[App\Http\Controllers\UserController::class,'login'])->name('login');//Login

Route::post('/upload',[App\Http\Controllers\ArchivoController::class,'upload']);//Subir pdf 


Route::group([
    'prefix' => 'auth'
], function (){
   Route::post('/register',[App\Http\Controllers\UserController::class,'register']);
   Route::post('/login',[App\Http\Controllers\UserController::class,'login']);
   Route::post('/logout',[App\Http\Controllers\UserController::class,'logout']);
});