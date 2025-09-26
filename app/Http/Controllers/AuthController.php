<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;  
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function registerlihat (){
         return view ('register');

    }
    public function registersubmit(Request $request){
        $data = new User();
        $data->username = $request->username;
        $data->email = $request->email;
        $data->password = bcrypt ($request->password);
        $data->save();
        return redirect()->route('register.lihat')->with('success', 'Registrasi berhasil');
        
    }

    public function login()  {
        return view('login');
    }

    public function loginSubmit(Request $request){

        $credentials=$request->validate([
            'email'=>['required','email'],
            'password'=>['required'],
        ]);
        
        if (auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended('/default')->with('sukses','selamat datang di dasboard');

        }
             return back()->withErrors([

                'email' => 'Username atau password salah.',
                ]);
        }

        public function default(){
            return view ('page.index');
        }



        

      
     
    }


