<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/collections';
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function guard()
    {
        return Auth::guard('admin');
    }

    public function username(){
        return 'username';
    }
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'username'   => 'required',
            'password' => 'required|min:3'
        ]);

        if($validator->fails()){
            dd($validator->errors());
        }

        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->intended('/collections');
        }
        return back()->withInput($request->only('username'));
    }

    public function logoutAdmin(Request $request){
        dd($request);
        $this->logout($request);
        
    }
}
