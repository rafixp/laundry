<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Req;
use App\Models\Member;
use App\Models\Transaksi;
use App\Models\detailTransaksi;
use App\Models\Paket;
use Auth;

date_default_timezone_set('Asia/Jakarta');

class kasirController extends Controller
{
    public function home(){
        return view('kasir.home');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function memberView(){
        $get = Member::all();
        return view('kasir.pelanggan.pelanggan', compact('get'));
    }

    public function tambahMemberView(){
        return view('kasir.pelanggan.tambahpelanggan');
    }

    public function tambahMember(Req $req){
        $data = $req->all();
        if(Member::create($data)){
            return redirect('/kasir/member');
        }
    }
    
    public function editMember(Req $req, $id){
        $cek = Member::findOrFail($id);
        $data = $req->all();
        if($cek->update($data)){
            return redirect('/kasir/member');
        }
    }

    public function editMemberView($id){
        $get = Member::findOrFail($id);
        return view('kasir.pelanggan.editpelanggan', compact('get'));
    }

    public function hapusMember($id){
        $cek = Member::findOrFail($id);
        if($cek->delete()){
            return redirect('/kasir/member');
        }
    }

    public function transaksiView(){
        $get = Transaksi::where('id_outlet', Auth::user()->id_outlet)->get();
        return view('kasir.transaksi.transaksi', compact('get'));
    }

    public function tambahTransaksiView(){
        $invoice = "CLN".date('Ymdhis');
        $pelanggan = Member::all();
        $paket = Paket::where('id_outlet', Auth::user()->id_outlet)->get();
        return view('kasir.transaksi.tambahtransaksi', compact('invoice','pelanggan','paket'));
    }

    public function tambahTransaksi(Req $req){
        $data = [
            "kode_invoice" => $req->kode_invoice,
            "id_outlet" => Auth::user()->id_outlet,
            "tgl" => date("Y-m-d"),
            "id_member" => $req->id_member,
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
            return redirect('/kasir/transaksi');
        }
    }

    public function konfirmasi($id){
        $get = detailTransaksi::where('kode_invoice', $id)->first();
        return view('kasir.transaksi.konfirmasi', compact('get'));
    }

    public function konfirmasiPesan(Req $req, $id){
        $total = $req->bayar - $req->total;
        $cek = Transaksi::where('kode_invoice', $req->kode_invoice);
        $kembalian = detailTransaksi::where('kode_invoice', $req->kode_invoice)->first();
        if($cek->update(["dibayar"=>"dibayar","status"=>"selesai","tgl_bayar"=>date('Y-m-d')]) && $kembalian->update(['kembalian'=> $total])){
            return redirect('/kasir/transaksi/invoice/'.$req->kode_invoice);
        }
    }

    public function invoice($id){
        $get = detailTransaksi::where('kode_invoice', $id)->first();
        $detail = Transaksi::where('kode_invoice', $id)->first();
        $tanggal = date('d F Y - H.i');
        return view('kasir.transaksi.invoice', compact('get','tanggal','detail'));
    }

    public function prosesPesanan($id){
        $cek = Transaksi::findOrFail($id);
        if($cek->update(["status"=>"proses"])){
            return redirect('/kasir/transaksi');
        }
    }

    public function cetak($id){
        $get = detailTransaksi::where('kode_invoice', $id)->first();
        $detail = Transaksi::where('kode_invoice', $id)->first();
        $tgl = date('d F Y - H.i');
        return view('kasir.transaksi.cetak', compact('get','detail','tgl'));
    }

    public function cetaklaporan(){
        $get = detailTransaksi::all();
        return view('kasir.datalaporan', compact('get')); 
    }

    public function generate(){
        $get = detailTransaksi::all();
        return view('kasir.generate', compact('get'));
    }
}
