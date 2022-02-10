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


