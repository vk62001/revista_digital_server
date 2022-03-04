<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;
use Illuminate\Support\Facades\DB;

class ComentController extends Controller
{
    public function uploaded (Request $req){

        $comentario = new Comentario();
        $comentario->name = $req->input('name');
        $comentario->comments = $req->input('comments');
        $comentario->save();

        return response()->json([
            "status"=>200,
            "file" => true
         ]);
       

    }

    public function listc(){
        
        $comentarios = DB::table('comentarios')->get();

        return $comentarios;

    }
    
}
