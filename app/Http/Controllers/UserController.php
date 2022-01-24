<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Redirect,Response,File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    function index(){
      
        return view('singup');

    }

    function register(Request $req){
     

        $name = $req->input('name');
        $email = $req->input('email');
        $password = Hash::make($req->input('password'));

        DB::table('users')->insert([
         'name' => $name,
         'email'=> $email,
         'password' => $password
        ]);

    }

    function login (Request $req){
     
        $email = $req->input('email');
        $password = $req->input('password');

        $user = DB::table('users')->where('email',$email)-first();
      

        if(!Hash::check($password, $user->password)){
          echo "La contraseña o el correo son incorrectos";

        }
        else{

           echo $user->email;

        }
    }
    
    
}
