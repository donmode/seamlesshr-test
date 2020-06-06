<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(Request $request){
        $allowedParams = ['email', 'password'];
        $credentials = $request->only($allowedParams); //accepts only email and password
        if($allowedParams != array_keys($credentials)){
            return response()->json(['error'=>"Missing required parameter(s)"], 400);
        }
        $token = auth()->attempt($credentials);
        if(!$token){
            return response()->json(['success' => false, 'error'=>"Incorrect email/password"], 401);
        }
        return response()->json(['success' => true,  'token'=>$token]);
    }
}
