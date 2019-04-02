@extends('admin.template')
@section('content')
    <center>
        <a href="{{ route('customer.add') }}" class="btn btn-success">Tambah Pengguna</a>
    </center>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengguna</th>
                    <th>Username</th>
                    <th>Alamat</th>
                    <th>No. KWH</th>
                    <th>Daya</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customer as $data)
                <tr>
                    <td>{{ ++$loop->index }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->username }}</td>
                    <td>{{ $data->address }}</td>
                    <td>{{ $data->kwh_number }}</td>
                    <td>{{ $data->power }}</td>
                    <td>
                        <a href="{{ route('customer.edit', ['id' => $data->id ]) }}" class="btn btn-warning">Edit</a> | <button class="btn btn-danger" onclick="deleteCustomer({{ $data->id }})">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection