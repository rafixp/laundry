@extends('admin.navbar')    

@section('content')
<br><br>
<div class="container bg-white mx-auto p-3 rounded mt-2 shadow">
    <h4>Konfirmasi Pemesanan</h4>
    <form action="/admin/transaksi/konfirmasi/{{$get->id}}" method="POST">
        @csrf
        <div class="form-group mt-2">
            <label>Kode Invoice</label>
            <input type="text" name="kode_invoice" class="form-control" value="{{$get->kode_invoice}}" readonly>
        </div>
        <div class="form-group mt-2">
            <label>Nama Pelanggan</label>
            <input type="text" name="kode_invoice" class="form-control" value="{{$get->id_member}}" readonly>
        </div>
        <div class="form-group mt-2">
            <label>Paket</label>
            <select name="paket" class="form-control">
                @foreach ($paket as $c)
                    <option value="{{$c->harga}}" onselect="hitung({{$c->harga}})">{{$c->nama_paket}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mt-2">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" id="jumlah">
        </div>
        <div class="form-group mt-2">
            <label>Total yang Harus dibayar</label>
            <input type="number" name="kode_invoice" class="form-control" id="total">
        </div>
        <div class="form-group mt-2">
           <button class="btn btn-sm btn-primary" type="submit"><i class="fas fa-save"></i> Simpan</button>
        </div>
    </form>
</div>
<br><br><br>
<script>
    function hitung(harga){
        var jum = document.getElementById('jumlah').value;
        var simpantotal = document.getElementById('total');
    }
</script>
@endsection