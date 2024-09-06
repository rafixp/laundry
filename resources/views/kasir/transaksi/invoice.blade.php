@extends('kasir.navbar')

@section('content')
    <div class="container card p-4 mt-5 w-50 fs-16">
        <h4>Detail Transaksi</h4>
        <table class="fs-16 text-start mt-2 mb-4">
            <tr>
                <td>Kode Invoice</td>
                <td>:</td>
                <td>{{$get->kode_invoice}}</td>
            </tr>
            <tr>
                <td>Nama Kasir</td>
                <td>:</td>
                <td>{{Auth::user()->name}}</td>
            </tr>
            <tr>
                <td>Tanggal Pembayaran</td>
                <td>:</td>
                <td>{{$tanggal}}</td>
            </tr>
        </table>

        <b>Detail Pesanan</b><br>
        <table border="1" style="border-collapse: collapse;">
            <tr>
                <th>Nama Konsumen</th>
                <th>Jumlah Pesanan</th>
                <th>Total Pembayaran</th>
                <th>Kembalian</th>
            </tr>
            <tr>
                <td>{{$get->nama_member}}</td>
                <td>{{$get->qty}}</td>
                <td>Rp. {{$get->total}}</td>
                <td>Rp. {{$get->kembalian}}</td>
            </tr>
        </table>
        <br><br>
        <h6 class="w-50 text-center mx-auto fs-16">Terimakasih telah mempercayai kami, kepuasan pelanggan adalah prioritas kami. Apabila anda mengalami keluhan, silahkan kontak lewat email support@laundry.id</h6>
        <br>
        <a href="/kasir/transaksi/cetak/{{$get->kode_invoice}}" class="btn btn-sm btn-primary" target="blank"><i class="fas fa-print"></i> Cetak Invoice</a>
    </div>
@endsection