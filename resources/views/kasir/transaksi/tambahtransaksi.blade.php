@extends('kasir.navbar')    

@section('content')
<br><br>
<div class="container bg-white mx-auto p-3 rounded mt-2 shadow">
    <h4>Transaksi Baru</h4>
    <form action="/kasir/transaksi/tambah" method="POST">
        @csrf
        <input type="hidden" name="id_user" value="{{ Auth()->user()->id }}">
        <div class="form-group mt-1">
            <label>Kode Invoice</label>
            <input type="text" name="kode_invoice" class="form-control form-sm" value="{{$invoice}}" readonly>
        </div>
        <div class="form-group mt-1">
            <label>Nama Pelanggan</label>
            <select name="id_member" class="form-control form-control">
                @foreach ($pelanggan as $b)
                    <option value="{{$b->nama}}">{{$b->nama}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mt-1">
            <label>Batas Waktu</label>
            <input type="date" name="batas_waktu" class="form-control form-sm">
        </div>
        <div class="form-group mt-2">
            <label>Paket</label>
            <select name="paket" class="form-control" id="paket">
                <option>Pilih Paket</option>
                @foreach ($paket as $c)
                    <option value="{{$c->harga}}" id="harga">{{$c->nama_paket}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mt-2">
            <label>Jumlah</label>
            <input type="number" name="qty" class="form-control" id="jumlah">
        </div>
        <div class="form-group mt-1">
            <label>Biaya Tambahan</label>
            <input type="number" name="biaya_tambahan" class="form-control form-sm" id="biaya">
        </div>
        <div class="form-group mt-1">
            <label>Diskon (%)</label>
            <input type="number" name="diskon" class="form-control form-sm" id="diskon">
        </div>
        <div class="form-group mt-1">
            <label>Pajak</label>
            <input type="number" name="pajak" class="form-control form-sm" id="pajak">
        </div>
        <div class="form-group mt-1">
            <button class="btn btn-sm btn-primary float-end"><i class="fas fa-save"></i> Simpan</button>
        </div>
    </form>
</div>
<br><br><br>
@endsection