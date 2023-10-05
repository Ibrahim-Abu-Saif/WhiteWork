<?php

// namespace App\Http\Controllers\Api;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    function login(Request $request){
        if(Auth::attempt($request->all())){
            $token = $request->user()->createToken('token_table');
            return ['token' => $token->plainTextToken];

        }
        else{
            return[
                'message'=>'User Not Found',
            ];
        }
    }
}

