<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link rel="stylesheet" href="/assets/css-bs/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/custom/custom.css">
</head>
<body class="p-5">
    <div class="container">
        <h6 class="mb-4">Detail Transaksi</h6>
    </div>
    <div class="container fs-15">
        <p>
            Kode Invoice : {{$get->kode_invoice}}<br>
            Tanggal Pembayaran : {{$tgl}}<br>
            Kasir : {{Auth::user()->name}}<br>
        </p>

        <strong>Detail Pesanan</strong>
        <table class="table table-sm table-bordered">
            <thead>
                <th>Nama</th>
                <th>Jumlah Pesanan</th>
                <th>Total Pembayaran</th>
                <th>Total</th>
            </thead>
            <tbody>
                <td>{{$get->nama_member}}</td>
                <td>{{$get->qty}}</td>
                <td>Rp. {{$get->total}}</td>
                <td>Rp. {{$get->kembalian}}</td>
            </tbody>
        </table>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>