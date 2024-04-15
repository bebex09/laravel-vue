<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){

        if (Auth::attempt($request->only('email', 'password'))) {
            /** @var User $user */
            $user = Auth::user();
            $token = $user->createToken('app')->accessToken;
        
            return response()->json([
                'message' => 'success',
                'token' => $token,
                'user' => $user->toArray() 
            ]);
        } else {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401); 
        }
    }
    public function register(RegisterRequest $request){
        try{
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name'=> $request->last_name,
                'email'=> $request->email,
                'password'=> Hash::make($request->password)
            ]);
    
            return $user;
        }catch(\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
        
    }

    public function user(){
        return Auth::user();
    }
}
