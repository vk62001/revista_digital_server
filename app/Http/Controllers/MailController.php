<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class MailController extends Controller
{
    public function sendEmail(){

        $details = [
        'title' => 'Correo de Freyser Olivera Santiago',
        'body' => 'Este es un ejemplo para enviar correos desde gmail'
        ];

         Mail::to("oliverafreyser@gmail.com")->send(new TestMail($details));
         return "Correo Electronico ENVIADO";
    }
}
