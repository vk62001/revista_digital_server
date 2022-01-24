<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
public function create() {



}
public function store(){

    $user = User::create(request(['nombre','correo','password']));

    auth()->login($user);
    redirect()->to('/');
}

}
