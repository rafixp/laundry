@extends('admin.navbar')

@section('content')
<br><br>
<div class="container bg-white p-4 shadow rounded">
    <h4>Data Transaksi</h4>
    <a href="/admin/transaksi/tambah" class="btn btn-sm btn-primary mb-2">Transaksi Baru</a>
    <table class="table table-bordered" id="datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Invoice</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal Pemesanan</th>
                <th>Status Pesanan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; ?>
            @foreach ($get as $a)            
                <tr>
                    <td><?= $i++?></td>
                    <td>{{$a->kode_invoice}}</td>
                    <td>{{$a->id_member}}</td>
                    <td>{{$a->tgl}}</td>
                    <td>{{$a->status}}</td>
                    <td>
                        @if ($a->status == "proses")
                            <a href="/admin/transaksi/konfirmasi/{{$a->kode_invoice}}" class="btn btn-sm btn-info m-1"><i class="fas fa-hand-holding-usd"></i></a>
                            <a href="/admin/transaksi/invoice/{{$a->id}}" class="btn btn-sm btn-primary m-1"><i class="fas fa-print"></i></a>
                        @elseif ($a->status == "selesai")
                            <a href="/admin/transaksi/invoice/{{$a->kode_invoice}}" class="btn btn-sm btn-primary m-1"><i class="fas fa-print"></i></a>
                        @else
                            <a href="/admin/transaksi/proses/{{$a->id}}" class="btn btn-sm btn-warning m-1" onclick="return confirm('Proses pesanan ini ?')" disabled><i class="fas fa-sync"></i></a>
                            <a href="/admin/transaksi/konfirmasi/{{$a->kode_invoice}}" class="btn btn-sm btn-info m-1"><i class="fas fa-hand-holding-usd"></i></a>
                            <a href="/admin/transaksi/invoice/{{$a->kode_invoice}}" class="btn btn-sm btn-primary m-1"><i class="fas fa-print"></i></a>

                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection