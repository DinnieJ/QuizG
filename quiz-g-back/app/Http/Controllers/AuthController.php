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
        $creds = $request->only('email','password');
        if($token = $this->guard()->attempt($creds)){
            return response()->json([
                'token' => $token,
            ],200);
        }

        return response()->json(['error'=> 'login error !'],401);
    }

    public function register(Request $request){
        $v = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:5|confirmed',
        ]);

        if($v->fails()){
            return response()->json([
                'error' => $v->errors()
            ],400);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json([
            'error' => 'Register successful'
        ],200);
    }

    public function user(){
        $user = User::find(Auth::user()->id);
        return response([
            'user' => $user
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
