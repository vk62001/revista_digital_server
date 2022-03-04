<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facade\File;
use Illuminate\Http\Request;
use App\Models\Titulo;
use Illuminate\Support\Facades\DB;


class ArchivoController extends Controller
{
    function upload(Request $req){

        if($req->hasfile("file")){
            $file = $req->file("file");
            $nameFile = $req->file->getClientOriginalName();
            $nombre = $req->input('titulo');
            $ruta = public_path("Revista/".$nameFile);
            if($file->guessExtension()=="pdf"){
                copy($file, $ruta);
            }
        }
    
        if($req->hasfile("image")){
        $file2 = $req->file('image');     
        $imagename = $file2->getClientOriginalName();
        $extension = $file2->getClientOriginalExtension();    
            $ruta2 = public_path("Revista/". $imagename);
        copy($file2, $ruta2);
        }
    
    
      $titulo = new Titulo();
      $titulo->name = $nombre;
      $titulo->file_path = $ruta;
      $titulo->image_path = $ruta2;
      $titulo->description = $req->input('description');
      $titulo->save();
    
      return response()->json([
         "status"=>200,
         "file" => true
      ]);
    
    
    }

    public function list(){
        
        $titulos = DB::table('titulos')->get();

           return $titulos;

        //Consulta solo los campos name y file_path
        //$titulos = DB::table('titulos')->select('name','file_path')->get();
        //return $titulos;
    }

    public function destroy($id){
       
        //Titulo::destroy($id);
        //return '{"msg":"Revista Eliminada"}';

        DB::table('titulos')->delete($id);

        return '{"msg":"Revista Eliminada"}';


       //Eliminar archivo de revista
        /**$file= Titulo::find($id);

        if(unlink($file->file_path)){
            $file->delete();
            return '{"msg":"Revista Eliminada"}';
        }else{
            return '{"msg":"Revista no encontrada"}';
        }*/
    }

    public function update(Request $req){

        $validatedData = $req->validate([
            'id' => 'required',
           'name' => 'required|string'
        ]);
        $titulo = Titulo::findOrFail( $req->input('id'));
        $titulo->name = $req->input('name');
        $titulo->save();
        
        
    
    
        $response['message'] = "Actualizado exitosamente";
        $response['success'] = true;
      return response()->json($response);
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


