<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\detailTransaksi;
use Auth;

class ownerController extends Controller
{
    public function home(){
        return view('owner.home');
    }

    public function laporan(){
        $get = detailTransaksi::all();
        return view('owner.laporan', compact('get'));
    }

    public function generate(){
        $get = detailTransaksi::all();
        return view('owner.generate', compact('get'));
    }

    public function logout(){
        if(Auth::logout()){
            return redirect('/');
        }
    }
}
