<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactanosMailable;



class MessagesController extends Controller
{
    public function sendEmail(Request $req){
       request()->validate([
           'nombre' => 'required',
           'correo'=> 'required',
           'mensaje' => 'required'
       ] );


       // enviar email 
      Mail::to('oliverafreyser@gmail.com')->send(new ContactanosMailable($req));


    }
    
}
