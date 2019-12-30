<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Validator;
use Hash;
class AuthController extends Controller
{
    public function login(Request $request){
        
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password'  => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()
            ],400);
        }
        $creds = ['email' => $request->email, 'password' => $request->password];
        if($token = $this->guard()->attempt($creds)){
            return response()->json([
                'token' => $token,
            ],200);
        }

         return response()->json(['error'=> 'failed'],401);
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:5|confirmed',
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()
            ],400);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json([
            'message' => 'Register successful'
        ],200);
    }

    public function user(){
        return response([
            'user' => Auth::user()
        ],200);
    }

    public function logout(){
        $this->guard()->logout();
        return response(['message' => 'Logout successful'],200);
    }



    private function guard(){
        return Auth::guard();
    }
}
