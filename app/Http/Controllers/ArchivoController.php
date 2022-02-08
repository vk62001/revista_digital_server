<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facade\File;
use Illuminate\Http\Request;

class ArchivoController extends Controller
{
    function upload(Request $req){

        $result = $req->file('file')->store('Archivos');
        return ["result"=>$result];
    }

    function download(Request $req){
        $path = storage_path('app\Archivos');
        return response()->download($path);
    }


}


