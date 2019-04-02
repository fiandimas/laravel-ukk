@extends('admin.template')
@section('content')
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengguna</th>
                    <th>No. KWh</th>
                    <th>Daya</th>
                    <th>Total Meter</th>
                    <th>Bulan Bayar</th>
                    <th>Ongkos Admin</th>
                    <th>Total Bayar</th>
                    <th>Tanggal Bayar</th>
                    <th>Status</th>
                    <th>Bukti</th>                
                </tr>
            </thead>
            <tbody>
                @foreach($history as $data)
                    <tr>
                        <td>{{ ++$loop->index }}</td>
                        <td>{{ $data->cname }}</td>
                        <td>{{ $data->kwh_number }}</td>
                        <td>{{ $data->power }}</td>
                        <td>{{ $data->total_meter }}</td>
                        <td>{{ $month[$data->month].','.$data->year }}</td>
                        <td>{{ $data->cost_admin }}</td>
                        <td>{{ $data->total_pay }}</td>
                        <td>{{ $data->date_pay }}</td>
                        <td>{{ $status[$data->status] }}</td>
                        <td><img src="{{ asset('/images/customer/bills/'.$data->image) }}" width="100px"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection