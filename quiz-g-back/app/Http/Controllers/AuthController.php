<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Validator;
use Hash;
class AuthController extends Controller
{
    public function login(Request $req){
        $request = json_decode($req->getContent(),true);
        $creds = ['email' => $request['email'], 'password' => $request['password']];
        if($token = $this->guard()->attempt($creds)){
            return response()->json([
                'token' => $token,
            ],200);
        }

        return response()->json(['error'=> 'login error !'],401);
    }

    public function register(Request $req){
        $request = json_decode($req->getContent(),true);
        $v = Validator::make($request, [
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:5|confirmed',
        ]);

        if($v->fails()){
            return response()->json([
                'error' => $v->errors()
            ],400);
        }

        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->save();
        return response()->json([
            'message' => 'Register successful'
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
