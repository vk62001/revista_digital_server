<?php

namespace App\Http\Controllers;

use App\Models\like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function uploadlike(Request $req){

        $like = new like();
        $like-> id = $req->input('id');
        $like->save();

        return response()->json([
        "status"=> 200,
        'id' => true
        ]);
    }
}
