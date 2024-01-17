<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Support\Facades\Hash ;
use Illuminate\Support\Facades\Session;

class AuthManager extends Controller
{
    function login()
    {
        if(Auth::check()){
            return redirect(route('home')) ;
        }
        return view('login') ;

    }
    function register()
    {
        return view('register') ;

    }

    function loginPost(Request $req)
    {
            $req->validate([
                'email'=>'required' ,
                'password'=>'required'
            ]);

            $x=$req->only('email','password') ;
            if(Auth::attempt($x))
            {
                return redirect()->intended(route('home'))->with("success","Login valid")  ;
            }
            return redirect(route('login'))->with("error" , "Login not valid !") ;

    }
    function registerPost(Request $req)
    {
        $req->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users' ,
            'password'=>'required'
        ]);
        $data['name']=$req->name; 
        $data['email']=$req->email;
        $data['password']=Hash::make($req->password);
        $user=User::create($data) ;

        if(!$user)
        {
            return redirect(route('register'))->with("error","registeration failed");
        }
        return redirect(route('login'))->with("success","registeration ok");

    }


    function logout()
    {
        Session::flush() ;
        Auth::logout();
        return redirect(route('home')) ;
    }

    

}
