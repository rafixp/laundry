@extends('admin.navbar')

@section('content')
    <div class="container mt-5 p-4 bg-white shadow rounded">
        <h4>Data Laporan</h4>
        <a href="/admin/laporan/generate" class="btn btn-sm btn-primary" target="blank"><i class="fas fa-print"></i> Generate Laporan</a><br><br>
        <table class="table" id="datatable">
            <thead>
                <th>No.</th>
                <th>Kode Invoice</th>
                <th>Nama Konsumen</th>
                <th>Tanggal Pembelian</th>
                <th>Total Pembayaran</th>
            </thead>
            <tbody>
                <?php $i=1; ?>
                @foreach ($get as $a)
                    <tr>
                        <td><?= $i++ ?></td>
                        <td>{{$a->kode_invoice}}</td>
                        <td>{{$a->nama_member}}</td>
                        <td>{{$a->created_at}}</td>
                        <td>Rp. {{$a->total}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection