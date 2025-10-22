<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{


    public function login()  {
        return view('login');
    }

    public function loginSubmit(Request $request){

        $credentials=$request->validate([
            'username'=>['required'],
            'password'=>['required'],
        ]);

        if (auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended('/home')->with('sukses','selamat datang di dasboard');

        }
             return back()->withErrors([

                'username' => 'Username atau password salah.',
                ]);
        }

        public function default(){
            return view ('page.index');
        }

    }


