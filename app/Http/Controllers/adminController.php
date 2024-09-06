<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Req;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\detailTransaksi;
use App\Models\Transaksi;
use App\Models\Member;
use App\Models\Outlet;
use App\Models\Paket;
use Hash;

date_default_timezone_set('Asia/Jakarta');

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
        $data = [
            "kode_invoice" => $req->kode_invoice,
            "id_outlet" => $req->id_outlet,
            "id_member" => $req->id_member,
            "tgl" => date('Y-m-d'),
            "batas_waktu" => $req->batas_waktu,
            "biaya_tambahan" => $req->biaya_tambahan,
            "diskon" => $req->diskon,
            "pajak" => $req->pajak,
            "id_user" => Auth::user()->id,
        ];

        $detil = [
            "kode_invoice" => $req->kode_invoice,
            "nama_member" => $req->id_member,
            "qty" => $req->qty,
            "total" => $req->paket * $req->qty + $req->biaya_tambahan % $req->diskon + $req->pajak,
        ];

        if(Transaksi::create($data) && detailTransaksi::create($detil)){
            return redirect('/admin/transaksi');
        }
    }

    public function prosesPesanan($id){
        $cek = Transaksi::findOrFail($id);
        if($cek->update(["status"=>"proses"])){
            return redirect('/admin/transaksi');
        }
    }
    
    public function konfirmasi($id){
        $get = detailTransaksi::where('kode_invoice', $id)->first();
        return view('admin.transaksi.konfirmasi', compact('get'));
    }

    public function konfirmasiPesan(Req $req, $id){
        $total = $req->bayar - $req->total;
        $cek = Transaksi::where('kode_invoice', $req->kode_invoice);
        $kembalian = detailTransaksi::where('kode_invoice', $req->kode_invoice)->first();
        if($cek->update(["dibayar"=>"dibayar","status"=>"selesai","tgl_bayar"=>date('Y-m-d')]) && $kembalian->update(['kembalian'=> $total])){
            return redirect('/admin/transaksi/invoice/'.$req->kode_invoice);
        }
    }

    public function invoice($id){
        $get = detailTransaksi::where('kode_invoice', $id)->first();
        $detail = Transaksi::where('kode_invoice', $id)->first();
        $tanggal = date('d F Y - H.i');
        return view('admin.transaksi.invoice', compact('get','tanggal','detail'));
    }

    public function cetak($id){
        $get = detailTransaksi::where('kode_invoice', $id)->first();
        $detail = Transaksi::where('kode_invoice', $id)->first();
        $tgl = date('d F Y - H.i');
        return view('admin.transaksi.cetak', compact('get','detail','tgl'));
    }

    public function cetaklaporan(){
        $get = detailTransaksi::all();
        return view('admin.datalaporan', compact('get')); 
    }

    public function generate(){
        $get = detailTransaksi::all();
        return view('admin.generate', compact('get'));
    }
}
