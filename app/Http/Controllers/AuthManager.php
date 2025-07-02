<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthManager extends Controller
{
    function login(){
        return view('auth.login');
    }

    function loginPost(Request $req){
        $req->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $req->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect()->intended(route('home'));
        }
        return redirect("login")
            ->with("error", "Invalid Email or Password");
    }

    function logout(){
        Auth::logout();
        return redirect('login')
            ->with("success", "Logged out successfully");
    }

    function register(){
        return view('auth.register');
    }

    function registerPost(Request $req){
        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = bcrypt($req->password);
        if($user->save()){
            return redirect()->intended(route('login'))
                ->with("success", "Registration successful. Please login."); 
        }
        return redirect(route('register'))->with("error", "Registration failed. Please try again.");
    }
}
