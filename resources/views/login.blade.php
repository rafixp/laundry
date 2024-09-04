<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Laundry.id</title>
    <link rel="stylesheet" href="/assets/css-bs/bootstrap.min.css">
</head>
<body style="background: url('/assets/img/bg-404.jpeg'); background-size: cover;">
    <br><br><br><br><br><br>
    <div class="container card bg-white shadow w-25 mx-auto mt-5 border-0">
        <div class="card-body p-5">
            <h4 class="mb-3">Login</h4>
            <form action="/login" method="POST">
                @csrf
                <div class="form-group mt-2">
                    <input type="email" name="email" class="form-control form-sm" placeholder="Email">
                </div>
                <div class="form-group mt-2">
                    <input type="password" name="password" class="form-control form-sm" placeholder="Password">
                </div>
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-sm btn-primary float-end">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>