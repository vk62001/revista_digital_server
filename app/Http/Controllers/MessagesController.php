<?php

namespace App\Http\Controllers;

use App\Mail\ContactanosMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class MessagesController extends Controller
{
    public function sendEmail(Request $req)
    {
        $req->validate([
            'nombre' => 'required',
            'correo' => 'required',
            'mensaje' => 'required'
        ]);

        $data = new \StdClass;
        $data->to = 'oliverafreyser@gmail.com';
        $data->nombre = $req->input('nombre');
        $data->correo = $req->input('correo');
        $data->mensaje = $req->input('mensaje');


        // enviar email
        Mail::to($data->to)->send( new ContactanosMailable($data));

    }

}
