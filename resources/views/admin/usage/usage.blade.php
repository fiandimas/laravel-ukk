@extends('admin.template')
@section('content')
    <center>
        <a href="{{ route('usage.add') }}" class="btn btn-success">Tambah Penggunaan</a> 
    </center>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengguna</th>
                    <th>No. KWh</th>
                    <th>Daya</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usage as $data)
                    <tr>
                        <td>{{ ++$loop->index }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->kwh_number }}</td>
                        <td>{{ $data->cost }}</td>
                        <td>
                            <a href="{{ route('usage.detail',['id' => $data->id ]) }}" class="btn btn-primary">Detail Penggunaan</a> | <a href="{{ route('bill.detail',['id' => $data->id ]) }}" class="btn btn-warning">Detail Tagihan</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection