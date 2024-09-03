@extends('admin.navbar')

@section('content')
<br><br>
<div class="container card bg-white">
    <div class="card-header">
        <a href="/admin/outlet/tambah" class="btn btn-sm btn-primary float-end">Tambah Outlet</a>
    </div>
    <div class="card-body">
        <table class="table table-sm table-bordered" id="datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Outlet</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; ?>
                @foreach ($get as $a)
                <tr>
                    <td><?= $i++?></td>
                    <td>{{$a->nama}}</td>
                    <td>{{$a->alamat}}</td>
                    <td>{{$a->tlp}}</td>
                    <td>
                        <a href="/admin/outlet/edit/{{$a->id}}" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt"></i></a>
                        <a href="/admin/outlet/hapus/{{$a->id}}" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data outlet ini ? ')"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection