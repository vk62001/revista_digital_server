<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function index(){
        return \App\Models\Usuario::all();
    }
    public function show(Usuario $usuario){
        return $usuario;

    }
    public function store(Request $request){
     $usuario = Usuario::create($request->all());
     return response()->json($article,201);
    }
    public function update(Request $request, Usuario $usuario){
        $usuario->update($request->all());
        return response()->json($usuario,200);
    }
    public function delete(Usuario $usuario){
       $usuario->delete();
       return response()->json(null,204);
    }
}
