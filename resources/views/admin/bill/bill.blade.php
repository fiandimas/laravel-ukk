@extends('admin/template')
@section('content')
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Bulan Penggunaan</th>
                    <th>Meter Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bill as $data)
                    <tr>
                        <td>{{ ++$loop->index }}</td>
                        <td>{{ $month[$data->month] }}, {{ $data->year }}</td>
                        <td>{{ $data->total_meter }}</td>
                        <td>
                            @if($data->status == 'n')
                                Belum Bayar
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a href="{{ route('usage') }}" class="btn btn-warning">Kembali</a>
@endsection