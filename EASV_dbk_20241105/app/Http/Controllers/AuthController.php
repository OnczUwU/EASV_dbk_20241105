<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function register(Request $request): void{
        $validatedData = $request ->validate(rules: [
            'name'=>['required','string','max:225'],
            'email'=>['required','string','max:225','unique:users'],
            'password'=>['required','string','min:8','max:20'],
        ]);

        $User = User::create([
            'name'=> $validatedData['name'],
            'email'=> $validatedData['email'],
            'password'=> Hash::make($validatedData['password']),
        ]);

        $token = $User->createToken('auth_token')->plainTextToken;

        return response()-> json([
            "Success"=>true,
            "errors"=>[
                "code"=>0,
                "msg"=>""
            ],
            "data"=>[
                "access_token"=>$token,
                "token_type" =>"Beaber"
            ],
            "msg"=>"Usuario creado sastisfactoriamente",
            "count"=>1
        ]);

        
    }
}
