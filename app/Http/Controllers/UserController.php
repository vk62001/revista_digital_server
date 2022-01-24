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
        //revisar si el correo ya existe
        //usamos variable
        //if("existe"){return json(200), 'data'=>"el correo ya existe"}
        //else{
        //registro
        //}



        $name = $req->input('name');
        $email = $req->input('email');
        $password = Hash::make($req->input('password'));

        $response = DB::table('users')->insert([
         'name' => $name,
         'email'=> $email,
         'password' => $password
        ]);
        if($response){
            return response()->json(['status'=>200,'data'=>true]);
        }else{
            return response()->json(['status'=>500, 'data'=>false]);
        }
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
