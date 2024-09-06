<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Generate Laporan Penjualan</title>
    <link rel="stylesheet" href="/assets/css-bs/bootstrap.min.css">
</head>
<body>
    <div class="text-center">
        <h4 class="mt-4">Laporan Transaksi Laundry</h4>
        <?= date('d F Y');?>
    </div>
    <table class="table table-sm table-bordered mx-auto mt-4 text-center">
        <thead>
            <th>No</th>
            <th>Kode Invoice</th>
            <th>Nama Konsumen</th>
            <th>Tanggal Pembelian</th>
            <th>Total Pembayaran</th>
        </thead>
        <tbody>
            <?php $i=1; ?> 
            @foreach ($get as $a)
            <tr>
                <td><?= $i++?></td>
                <td>{{$a->kode_invoice}}</td>
                <td>{{$a->nama_member}}</td>
                <td>{{$a->created_at}}</td>
                <td>Rp. {{$a->total}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        window.print();
    </script>
    </body>
</html>