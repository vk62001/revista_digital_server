<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Redirect,Response,File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    function index(){
      
        return view('singup');

    }

    function register(Request $req){
          
        $req->validate([
        'name' => 'required',
        'email' => 'required',
        'password' => 'required'

        ]);
            $name = $req->input('name');
            $email = $req->input('email');
            $password = Hash::make($req->input('password'));

       $validate = DB::table('users')->where('email',$email)->first();
        if($validate ===null){
            $response = DB::table('users')->insert([
             'name' => $name,
             'email'=> $email,
             'password' => $password
            ]);
            $response = array(
                "user" => true,
                "email"=>false,
            );
            return response()->json(['status'=>200,'data'=>$response]);

        }else{
            $response = array(
                "user" => true,
                "email"=> true,
            );
            return response()->json(['status'=>200,'data'=>$response]);
        }
       
    }

    function login (Request $req){
       
        $validator = Validator::make($req->all(),[
          'email'=>'required|email',
          'password'=>'required',

        ]);;

       if($validator->fails()){

         return response()->json([
             'validation_errors'=>$validator->messages(), 
 
         ]);

       }else{
             $user = User::where('email', $req->email)->first();

             if (! $user || ! Hash::check($req->password, $user->password)) {
                 return response()->json([
                   'status'=>'401',
                   'message'=>'Correo o contraseña incorrectos.',
                 ]);
           }else{
               return response()->json([
                  'status'=>202,
                  'username'=>$user->name,
                'message'=>'Has iniciado sesion',
               ]);
           }


       }
    }
    
}
    

