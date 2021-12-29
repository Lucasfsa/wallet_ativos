<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request, User $user)
    {
        $autenticacao = $request->only('name','email','password');
        $autenticacao['password'] = bcrypt($autenticacao['password']);
        
        if(!$user = $user->create($autenticacao))
        abort(500, "Falha ao cadastrar!");

        return response()->json(['data'=>['user'=>$user]]);
    }
}
