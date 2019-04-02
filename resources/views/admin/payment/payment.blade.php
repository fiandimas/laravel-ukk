@extends('admin.template')
@section('content')
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Bayar</th>
                    <th>Nama Pengguna</th>
                    <th>No. KWH</th>
                    <th>Total Meter</th>
                    <th>Biaya Admin</th>
                    <th>Total Bayar</th>
                    <th>Daya</th>
                    <th>Bukti</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
               @foreach($payment as $data)
                    <tr>
                        <td>{{ ++$loop->index }}</td>
                        <td>{{ $data->date_pay }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->kwh_number }}</td>
                        <td>{{ $data->total_meter }}</td>
                        <td>Rp. {{ number_format(5000) }}</td>
                        <td>Rp. {{ number_format($data->total_pay) }}</td>
                        <td>{{ $data->power }}</td>
                        <td><img src="{{ asset('images/customer/bills/'.$data->image) }}" width="100px"></td>
                        <td>{{ $status[$data->status] }}</td>
                        <td>
                            @if($data->status == 'r')
                                <button class="btn btn-success" onclick="accept({{ $data->id }})" disabled>Accept</button>
                                <button class="btn btn-danger" onclick="reject({{ $data->id }})" disabled>Reject</button>
                            @else
                                <button class="btn btn-success" onclick="accept({{ $data->id }})">Accept</button>
                                <button class="btn btn-danger" onclick="reject({{ $data->id }})">Reject</button>
                            @endif
                        </td>
                    </tr>
               @endforeach
            </tbody>
        </table>
    </div>
@endsection