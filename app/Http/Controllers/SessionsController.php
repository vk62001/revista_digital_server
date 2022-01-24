<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SessionsController extends Controller
{
    public function create(){


    }

    public function store(){
        if(auth()->attempt(request(['email','password']))== false){
            return back()->withErrors([
            'message' => 'El email o la contraseña son incorrectos,
            porfavor intenta de nuevo'
            ]);
        }
        return redirect()->to('/');
    }
    public function destroy (){
        auth()->logout();
        return redirect()->to('/');
    }
}
