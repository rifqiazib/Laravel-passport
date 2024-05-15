<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Hash;
use Exception;

class AuthenticationController extends Controller
{
    public function register (Request $request){

            $validator = Validator::make($request->all(),[
                'name' => 'required|max:100',
                'email' => 'required|max:100',
                'password' => 'required|min:6',
            ]);

            if($validator->fails()){
                return response()->json($validator->errors(), 400);
            }
            
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'succes' => 'True',
                'message' => 'Register succes!',
                'data' => $user
            ]); 
    }

    public function login (Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->erorrs(), 400);
        }

        $user = User::Where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'succes' => 'false',
                'message' => 'email or password wrong'
            ], 401);
        } else {
            return response()->json([
                'succes' => 'true',
                'message' => 'login success',
                'data' => $user,
                'token' => $user->createToken('authToken')->accessToken    
            ],401);
        }
    }

    public function logout (){
        
        if(Auth::check()) {
            $user = Auth::user();
            $token = $user->token();

            if($token) {
                $token->revoke();

                return response()->json([
                    'message' => 'Logout Successfully'
                ]);
            } else {
                return response()->json([
                    'message' => 'Unable to revoke token'
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Logout failed, User not authenticated'
            ],401);
        }

    }
}
