<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index',[
            'title'=>'Register',
            'active'=>'register'
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'=>'required|max:255|alpha',
            'username' => ['required','min:3','max:255','unique:users'],
            'email'=>'required|email:dns|unique:users',
            'password'=>'required|min:5|max:255',
        ]);

        $validate['password'] = bcrypt($validate['password']);
        // dd($request->all());
        User::create($validate);

        // $request->session()->flash('daftar', "User {$validate['name']} berhasil didaftarkan");
        return redirect('/login')->with('daftar', "User <strong>{$validate['name']}</strong> berhasil didaftarkan");
    }
}
