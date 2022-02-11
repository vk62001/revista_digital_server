<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facade\File;
use Illuminate\Http\Request;
use App\Models\Titulo;


class ArchivoController extends Controller
{
    function upload(Request $req){
        if($req->hasfile("file")){
            $file = $req->file("file");
            $nombre = $req->file->getClientOriginalName();
            
            $ruta = public_path("revista/".$nombre);

            $titulo = new Titulo();
            $titulo->name = "";
            $titulo->file_path = "";
            $titulo->save();
            

            if($file->guessExtension()=="pdf"){
                copy($file, $ruta);
            $titulo = new Titulo();
            $titulo->name = $nombre;
            $titulo->file_path = $ruta;
            $titulo->save();
            }else{
                dd("NO ES UN PDF");
            }
        }


        /*$result = $req->file('file')->store('Archivos');
        $resultado = $req->file('file');
        return ["result"=>$result];*/

        /*return response()->json([
               "status"=>200,
               "file" => $resultado
              ]);*/
    }

    function download(Request $req){
        $path = storage_path('app\Archivos');
        return response()->download($path);
    }

    function generateUuidv4()
{
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
    // 32 bits for "time_low"
    mt_rand(0, 0xffff), mt_rand(0, 0xffff),
    // 16 bits for "time_mid"
    mt_rand(0, 0xffff),
    // 16 bits for "time_hi_and_version",
    // four most significant bits holds version number 4
    mt_rand(0, 0x0fff) | 0x4000,
    // 16 bits, 8 bits for "clk_seq_hi_res",
    // 8 bits for "clk_seq_low",
    // two most significant bits holds zero and one for variant DCE1.1
    mt_rand(0, 0x3fff) | 0x8000,
    // 48 bits for "node"
    mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );

echo generateUuidv4();
}


}


