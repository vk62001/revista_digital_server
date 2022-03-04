<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Mail\ContactanosMailable;
use Illuminate\Support\Facades\Mail;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




/*Route::get('/enviar',function(){

    $correo = new ContactanosMailable;
  
    Mail::to('oliverafreyser@gmail.com')->send($correo);
  
    return "Mensaje Enviado";
  
  });*/
//Route::post('/registro',[App\Http\Controllers\UserController::class,'register']);

//Route::post('/register',[App\Http\Controllers\UserController::class,'register']); //Registro

//Route::post('/login',[App\Http\Controllers\UserController::class,'login'])->name('login');//Login

Route::post('/send',[App\Http\Controllers\MessagesController::class,'sendEmail']);//Enviar Correo





Route::post('/upload',[App\Http\Controllers\ArchivoController::class,'upload']);//Subir pdf

Route::post('/uploaded',[App\Http\Controllers\ComentController::class,'uploaded']);//Subir Comentarios

Route::get('/listc',[App\Http\Controllers\ComentController::class,'listc']);//Listar Comentarios

Route::get('/list',[App\Http\Controllers\ArchivoController::class,'list']); //Listar datos

Route::post('/update',[App\Http\Controllers\ArchivoController::class,'update']);//Actualizar datos

Route::delete('/delete/{id}',[App\Http\Controllers\ArchivoController::class,'destroy']);
Route::group([
    'prefix' => 'auth'
], function (){
   Route::post('/register',[App\Http\Controllers\UserController::class,'register']);
   Route::post('/login',[App\Http\Controllers\UserController::class,'login']);
   Route::post('/logout',[App\Http\Controllers\UserController::class,'logout']);
});