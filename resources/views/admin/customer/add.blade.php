@extends('admin.template')
@section('content')
    <form action="{{ route('customer.create') }}" id="form">
        <div class="row">
            <div class="col-md-4">
                <label class="control-label">Name</label>
                <input type="text" class="form-control" name="name">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="control-label">Username</label>
                <input type="text" class="form-control" name="username">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="control-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="control-label">No. KWh</label>
                <input type="number" class="form-control" name="kwh_number">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="control-label">Alamat</label>
                <input type="text" class="form-control" name="address">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="control-label">Tarif</label>
                <select class="form-control" name="id_cost">
                    @foreach($cost as $data)
                        <option value="{{ $data->id }}">{{ $data->power }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <input type="submit" value="Simpan" class="btn btn-success" id="btnSubmit">
            </div>
        </div>
        <a href="{{ route('customer') }}" class="btn btn-warning">Kembali</a>
    </form>
@endsection