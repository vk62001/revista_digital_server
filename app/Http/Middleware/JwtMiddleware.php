<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try{
            $user = JWAuth::parseToken()->authenticate();
        }catch(Exception $e){
            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(["msg"=>"Invalid Token"]);
            }if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpired\Exception){
              return response()->json(["msg"=> "Token is expired"]);
            }
            return response()->json(["msg"=> "Token not found"]);

        }
        return $next($request);
    }
}
