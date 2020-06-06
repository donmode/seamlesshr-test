<?php

namespace App\Http\Controllers\Api\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ];

        $input     = $request->only('name', 'email','password');

        // if(array_keys($rules) != array_keys($input)){
        //     return response()->json(['error'=>"Missing required parameter(s)"], 400);
        // }

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }
        $name = $request->name;
        $email    = $request->email;
        $password = $request->password;
        
        $user     = User::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password)]);
        
        return response()->json(['success' => true, 'message' => "Record created successfully"]);
    }
}