<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        if (Auth::attempt($request->only('email', 'password'))) {
            // Authentication successful
            $user = Auth::user();
            $token = $user->createToken('app')->accessToken;
        
            return response()->json([
                'message' => 'success',
                'token' => $token,
                'user' => $user->toArray() // Convert the user object to an array for better JSON serialization
            ]);
        } else {
            // Authentication failed
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401); // Unauthorized status code
        }
        

    }
}
