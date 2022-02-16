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
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    /**
     * Create a new AuthController instance
     * @return void
     */

     public function __construct(){
         $this->middleware('jwt',['except'=>['login','register']]);
     }

   public function register(Request $req){

        //Register  

        $req->validate([
        'name' => 'required',
        'email' => 'required',
        'password' => 'required'

        ]);

        //$credentials = $req->only('name','email', 'password');
        
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
    /**
     * Get a JWT via given credentials.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    function login (Request $req){
          $credentials = $req->only('email', 'password');

          $validator = Validator::make($credentials,[
             "email" => "required|email",
             "password" => "required"
          ]);

          if($validator->fails()){
           return response()->json([
            "status"=>422,
            "success" => false,
            "message" => "Wrong Validation",
            "errors" => $validator->errors()
           ]);
          }

          $token = JWTAuth::attempt($credentials);   

          if($token){
            $user = User::where("email", $credentials['email'])->get()->first();
            $userArray = array(
                "email"=>$user['email'],
                "username"=>$user['name'],
                "token"=>$token
            );
              return response()->json([
                "status"=>200,
                "success" => true,
                "user" => $userArray
              ]);
          }else{
              return response()->json([
               "success" => false,
               "message" => "Correo o Contraseña incorrectos",
               "errors" => $validator->errors()
              ]);
          }
       /* 
        $validator = Validator::make($req->all(),[
          'email'=>'required|email',
          'password'=>'required',

        ]);;

       if($validator->fails()){
         return response()->json(['validation_errors'=>$validator->messages(),]);
       }else{
            
            $user = User::where('email', $req->email)->first();
            if (!$user || !Hash::check($req->password,$user->password)) {
                 return response()->json([
                   'status'=>'401',
                   'message'=>'Correo o contraseña incorrectos.',
                     ]);
            }else{
               return response()->json([
                  'status'=>202,
                  'username'=>$user->name
               ]);
            }
       }*/
    }

    /**
     * Get the token array structure.
     * 
     * @param string $token
     * 
     * @return \Illuminate\Http\JsonResponse
     */

     protected function respondWithToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            //'expires_in' => auth()->factory()->getTTL() * 60
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
     }
     
     /**
      * Log the user out (invalidate the token).
      *
      *@return \Illuminate\Htpp\JsonResponse
      */
     public function logout(){
         auth()->logout();

         return response()->json(['message' => 'Successfully logged out']);
     }
    
}
    

