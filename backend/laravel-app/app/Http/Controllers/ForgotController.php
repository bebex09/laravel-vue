<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ForgotRequest;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;



class ForgotController extends Controller
{
    //
    public function forgot(ForgotRequest $request){

        $email = $request->input('email');
        if(User::where('email',  $email)->doesntExist()) {
            return response()->json([
                'message' => 'User doesn\'t exists'
            ], status: 404);
        }

        $token  = Str::random(10);
        try {
            //code...
            DB::table('password_reset_tokens')->insert([
                'email' => $email,
                'token'=> $token
            ]);
            return response([
                'message'=> 'check you email'
            ]);

        } catch (\Throwable $e) {
            //throw $th;
            return response()->json([
                'message' => $e->getMessage()
            ], status: 400);
        }
    }
}
