@extends('admin.template')
@section('content')
    <form action="{{ route('usage.create') }}" id="form">
        <div class="row">
            <div class="col-md-4">
                <label class="control-label">Nama Pengguna</label>
                <select name="id_customer" class="form-control" id="id_customer">
                    @foreach($customer as $data)
                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="control-label">Tahun</label>
                <select name="year" class="form-control" id="year">
                    @for($i=2019;$i<=2024;$i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="control-label">Bulan</label>
                <select name="month" class="form-control" id="month"></select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="control-label">Meter Awal</label>
                <input type="number" class="form-control" name="start_meter">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="control-label">Meter Akhir</label>
                <input type="number" class="form-control" name="finish_meter">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <input type="submit" class="btn btn-success" value="Simpan" id="btnSubmit">
            </div>
        </div>
    </form>

    <a href="{{ route('usage') }}" class="btn btn-warning">Kembali</a>
@endsection