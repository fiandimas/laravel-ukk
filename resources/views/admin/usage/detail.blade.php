@extends('admin/template')
@section('content')
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Bulan Penggunaan</th>
                    <th>Meter Awal</th>
                    <th>Meter Akhir</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usage as $data)
                    <tr>
                        <td>{{ ++$loop->index }}</td>
                        <td>{{ $month[$data->month] }}, {{ $data->year }}</td>
                        <td>{{ $data->start_meter }}</td>
                        <td>{{ $data->finish_meter }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a href="{{ route('usage') }}" class="btn btn-warning">Kembali</a>
@endsection