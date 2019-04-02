@extends('customer.template')
@section('content')
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Total Meter</th>
                    <th>Biaya Admin</th>
                    <th>Total Bayar</th>
                    <th>Status</th>
                    <th>Bukti</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bill as $data)
                    <tr>
                        <td>{{ ++$loop->index }}</td>
                        <td>{{ $month[$data->month] }}</td>
                        <td>{{ $data->year }}</td>
                        <td>{{ $data->total_meter }}</td>
                        <td>Rp. {{ number_format(5000) }}</td>
                        <td>Rp. {{ ($data->cost * $data->total_meter) + 5000 }}</td>
                        <td>
                            @if ($data->status == 'r')
                                <p style="color:red;font-size:15px">{{ $status[$data->status] }}</p>
                            @elseif($data->status == 'y')
                                <p style="color:green;font-size:15px">{{ $status[$data->status] }}</p>
                            @else
                                {{ $status[$data->status] }}
                            @endif
                        </td>
                        <td><img src="{{ asset('images/customer/bills/'.$data->image) }}" width="100px"></td>
                        <td>
                            @if($data->status == 'n' || $data->status == 'r')
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#defaultModal" onclick="cek({{ $data->id }})">Upload Bukti</button>
                            @elseif($data->status == 'p' || $data->status == 'y')
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#defaultModal" onclick="cek({{ $data->id }})" disabled>#</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Upload Bukti</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('bill.pay') }}" enctype="multipart/form-data" id="form">
                        @csrf
                        <input type="hidden" class="form-control" readonly id="id_bill" name="id_bill">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="file" class="form-control" required name="image" id="image">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-success" value="submit" id="btnSubmit" value="Simpan">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function cek(id_bill){
            $('#id_bill').val(id_bill)
        }
    </script>   
@endsection