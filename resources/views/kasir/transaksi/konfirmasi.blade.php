@extends('kasir.navbar')    

@section('content')
<br><br>
<div class="container bg-white mx-auto p-3 rounded mt-2 shadow">
    <h4>Konfirmasi Pembayaran</h4>
    <form action="/kasir/transaksi/konfirmasi/{{$get->id}}" method="POST">
        @csrf
        <div class="form-group mt-2">
            <label>Kode Invoice</label>
            <input type="text" name="kode_invoice" class="form-control" value="{{$get->kode_invoice}}" readonly>
        </div>
        <div class="form-group mt-2">
            <label>Nama Pelanggan</label>
            <input type="text" name="nama" class="form-control" value="{{$get->nama_member}}" readonly>
        </div>
        <div class="form-group mt-2">
            <label>Total Keseluruhan</label>
            <input type="number" name="total" class="form-control" id="total" value="{{$get->total}}" readonly>
        </div>
        <div class="form-group mt-2">
            <label>Nominal Pembayaran</label>
            <input type="number" name="bayar" class="form-control" id="jumlah">
        </div>
        <div class="form-group mt-2">
           <button class="btn btn-sm btn-primary" type="submit"><i class="fas fa-save"></i> Simpan</button>
        </div>
    </form>
</div>
<br><br><br>
@endsection