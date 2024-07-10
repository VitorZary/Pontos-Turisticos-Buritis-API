<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    
    use HttpResponses;

    public function login(Request $request)
    {
        if(Auth::attempt($request->only('email', 'password'))){
            return $this->response('Authorized', 200, [
                'id' => $request->user()->id,
                'nome' => $request->user()->nome,
                'token' => $request->user()->admin == true ? $request->user()->createToken('admin', ['admin', 'user'])->plainTextToken : $request->user()->createToken('usuario', ['user'])->plainTextToken,
                'admin' => $request->user()->admin
            ]);
        }

        return $this->response('Not Authorized', 403);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->response('Token Revoked', 200);
    }
}
