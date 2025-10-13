<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup(Request $request){
        $credentials = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (Auth::attempt($credentials)) {  
            return response()->json([
                'message' => 'Adm Criado com successo',
                $user
            ],201);
        }
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required',
        ]);

        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('user_token')->plainTextToken;
            
            return response()->json([
                'message' => 'Login bem sucedido',
                'token' => $token
            ]);     
        }
    }
}
