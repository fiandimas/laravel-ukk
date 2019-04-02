@extends('admin.template')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Admin</th>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admin as $data)
                        <tr>
                            <td>{{ ++$loop->index }}</td>
                            <td>{{ $data->aname }}</td>
                            <td>{{ $data->username }}</td>
                            <td>{{ $data->lname }}</td>
                            <td>
                                <a href="{{ route('admin.edit', ['id' => $data->id ]) }}" class="btn btn-warning">Edit</a> | <button onclick="deleteAdmin({{ $data->id }})" class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <form action="{{ route('admin.create') }}" id="form">
                <div class="row">
                    <div class="col-md-12">
                        <label class="control-label">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>            
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="control-label">Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>            
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="control-label">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>            
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="control-label">Level</label>
                        <select class="form-control" name="id_level">
                            @foreach($level as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>            
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input type="submit" value="Simpan" class="btn btn-success" id="btnSubmit">
                    </div>            
                </div>
            </form>
        </div>
    </div>
@endsection