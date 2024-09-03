<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Req;
use App\Models\User;
use App\Models\detailTransaksi;
use App\Models\Transaksi;
use App\Models\Member;
use App\Models\Outlet;
use App\Models\Paket;
use Hash;

class adminController extends Controller
{
    public function adminHome(){
        return view('admin.home');
    }

    public function paketView(){
        $get = Paket::latest()->get();
        return view('admin.paket.paket', compact('get'));
    }

    public function tambahPaketView(){
        $get = Outlet::latest()->get();
        return view('admin.paket.tambahpaket', compact('get'));
    }

    public function tambahPaket(Req $req){
        $data = $req->all();
        if(Paket::create($data)){
            return redirect('/admin/paket');
        }
    }

    public function hapusPaket($id){
        $hapus = Paket::findOrFail($id);
        if($hapus->delete()){
            return redirect('/admin/paket');
        }
    }

    public function editPaketView($id){
        $paket = Paket::findOrFail($id);
        $get = Outlet::latest()->get();
        return view('admin.paket.editpaket', compact('paket','get'));
    }

    public function editPaket(Req $req, $id){
        $cek = Paket::findOrFail($id);
        $data = $req->all();
        if($cek->update($data)){
            return redirect('/admin/paket');
        }
    }
    public function outletView(){
        $get = Outlet::latest()->get();
        return view('admin.outlet.outlet', compact('get'));
    }

    public function tambahOutletView(){
        return view('admin.outlet.tambahoutlet');
    }

    public function tambahOutlet(Req $req){
        $data = $req->all();
        if(Outlet::create($data)){
            return redirect('/admin/outlet');
        }
    }

    public function hapusOutlet($id){
        $cek = Outlet::findOrFail($id);
        if($cek->delete()){
            return redirect('/admin/outlet');
        }
    }

    public function editOutletView($id){
        $get = Outlet::findOrFail($id);
        return view('admin.outlet.editoutlet', compact('get'));
    }

    public function editOutlet(Req $req, $id){
        $cek = Outlet::findOrFail($id);
        $data = $req->all();
        if($cek->update($data)){
            return redirect('/admin/outlet');
        }
    }

    public function memberView(){
        $get = Member::latest()->get();
        return view('admin.pelanggan.pelanggan', compact('get'));
    }

    public function tambahMemberView(){
        return view('admin.pelanggan.tambahpelanggan');
    }

    public function editMemberView($id){
        $get = Member::findOrFail($id);
        return view('admin.pelanggan.editpelanggan', compact('get'));
    }

    public function tambahMember(Req $req){
        $data = $req->all();
        if(Member::create($data)){
            return redirect('/admin/member');
        }
    }

    public function editMember(Req $req, $id){
        $cek = Member::findOrFail($id);
        $data = $req->all();
        if($cek->update($data)){
            return redirect('/admin/member');
        }
    }

    public function hapusMember($id){
        $cek = Member::findOrFail($id);
        if($cek->delete()){
            return redirect('/admin/member');
        }
    }

    public function userView(){
        $get = User::latest()->get();
        return view('admin.user.user', compact('get'));
    }

    public function tambahUserView(){
        $get = Outlet::latest()->get();
        return view('admin.user.tambahuser', compact('get'));
    }

    public function editUserView($id){
        $get = User::findOrFail($id);
        $outlet = Outlet::latest()->get();
        return view('admin.user.edituser', compact('get','outlet'));
    }

    public function tambahUser(Req $req){
        $data = $req->all();
        if(User::create($data)){
            return redirect('/admin/user');
        }
    }

    public function editUser(Req $req,$id){
        $cek = User::findOrFail($id);
        $data = [
            "name" => $req->nama,
            "email" => $req->email,
            "password" => $req->password ? Hash::make($req->password) : $cek->password,
            "role" => $req->role
        ];

        if($cek->update($data)){
            return redirect('/admin/user');
        }
    }

    public function hapusUser($id){
        $cek = User::findOrFail($id);
        if($cek->delete()){
            return redirect('/admin/user');
        }
    }

    public function transaksiView(){
        $get = Transaksi::latest()->get();
        return view('admin.transaksi.transaksi', compact('get'));
    }

    public function tambahTransaksiView(){
        $invoice = "CLN".date('YmdHis');
        $get = Outlet::latest()->get();
        $paket = Paket::latest()->get();
        $pelanggan = Member::latest()->get();
        return view('admin.transaksi.tambahtransaksi', compact('invoice','get','pelanggan','paket'));
    }

    public function tambahTransaksi(Req $req){
        $data = $req->all();
        if(Transaksi::create($data)){
            return redirect('/admin/transaksi');
        }
    }

    public function konfirmasi($id){
        $get = Transaksi::findOrFail($id);
        $paket = Paket::latest()->get();
        return view('admin.transaksi.konfirmasi', compact('get','paket'));
    }

    public function cetakInvoice($id){
        $get = Transaksi::findOrFail($id);
        $tgl = date('d F Y - H.i');
        return view('admin.transaksi.cetak', compact('get','tgl'));
    }
}
