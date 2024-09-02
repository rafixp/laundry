<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use Auth;
use Session;

class authController extends Controller
{
    public function loginView(){
        return view('login');
    }

    public function isLogin(){
        if(Auth::check()){
            return redirect('home');
        }else{
            return redirect('/');
        }
    }

    public function login(Request $req){
        $data = $req->only(['email','password']);

        if(Auth::attempt($data)){
            return redirect('/admin/home');
        }else{
            Session::flash('error','The email that you fill is not match on our records !');
            return redirect('/');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
