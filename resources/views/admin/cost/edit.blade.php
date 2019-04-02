@extends('admin.template')
@section('content')
    <form action="{{ route('cost.update', ['id' => $cost->id ]) }}" id="form">
        <div class="row">
            <div class="col-md-4">
                <label class="control-label">Daya</label>
                <input type="number" class="form-control" name="power" value="{{ $cost->power }}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="control-label">Tarif/Kwh</label>
                <input type="number" class="form-control" name="cost" value="{{ $cost->cost }}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <input type="submit" id="btnSubmit" class="btn btn-success" value="Simpan">
            </div>
        </div>
        <a href="" class="btn btn-warning">Kembali</a>
    </form>
@endsection