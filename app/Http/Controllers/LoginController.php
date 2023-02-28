<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view("login.index", [
        'active'=>'login',
        'title' => "Login",
        ]);
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email'=>['required','email'],
            'password'=>['required'],
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        else
        {
            return back()->with('loginError','Login gagal');
        }
    }

    public function logout()
    {
        Auth::logout();
 
        request()->session()->invalidate();
    
        request()->session()->regenerateToken();
    
        return redirect('/');
    }
}
