<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginUserRequest;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

    //use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
    public function index()
    {
        return view('auth.login');
    }
    public function Login(LoginUserRequest $request)
    {

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // return redirect()->intended('/');
            if (auth()->user()->CategoryUser->name_category_users == 'admin') {
                return redirect()->route('home.index');
            }else if (auth()->user()->CategoryUser->name_category_users == 'gerant') {
                return redirect()->route('home.homegerant');
            }else if (auth()->user()->CategoryUser->name_category_users == 'gestionnaire'){
                return redirect()->route('home.user');
            }
        }else {
            return redirect()->route('login');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerate(true);

        return redirect()->route('login');
    }
}
