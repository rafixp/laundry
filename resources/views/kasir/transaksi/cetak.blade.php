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
<body class="p-5 courier">
    <div class="container">
        <h6 class="mb-4">Bukti Pembayaran</h6>
    </div>
    <div class="container fs-15">
        <p>
            Kode Invoice : {{$get->kode_invoice}}<br>
            Tanggal Pembayaran : {{$tgl}}<br>
            Kasir : Nurhadi <br>
            Outlet : Mangunreja
        </p>

        <strong>Detail Pesanan</strong>
        <table class="table">
            <thead>
                <th>#</th>
                <th>Paket</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
            </thead>
            <tbody>
                <td>1</td>
                <td>Paket Selimut</td>
                <td>3</td>
                <td>20000</td>
                <td>60000</td>
            </tbody>
        </table>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>