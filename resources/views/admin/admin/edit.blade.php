@extends('admin.template')
@section('content')
    <div class="row">
        <div class="col-md-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        </div>
    </div>
    <form action="{{ route('admin.update',['id' => $admin->id ]) }}" id="form">
        <div class="row">
            <div class="col-md-4">
                <label class="control-label">Name</label>
                <input type="text" class="form-control" value="{{ $admin->name }}" name="name">
                <p style="color:red">{{ $errors->first('name') }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="control-label">Username</label>
                <input type="text" class="form-control" value="{{ $admin->username }}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="control-label">Password</label>
                <input type="password" class="form-control" value="password" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="control-label">Level</label>
                <select class="form-control" name="id_level">
                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                    <option value="{{ $levelNotSelect->id }}">{{ $levelNotSelect->name }}</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <input type="submit" class="btn btn-success" id="btnSubmit" value="Simpan">
            </div>
        </div>
    </form>

    <a href="{{ url('admin/admin') }}" class="btn btn-warning">Kembali</a>
@endsection