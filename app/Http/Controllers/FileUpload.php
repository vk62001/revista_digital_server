<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
class FileUpload extends Controller
{
    public function fileUpload(Request $req){

     $req->validate([
      'file'=> 'required'
     ]);

    }
}
