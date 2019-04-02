@extends('admin.template')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Daya</th>
                            <th>Tarif</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cost as $data)
                        <tr>
                            <td>{{ ++$loop->index }}</td>
                            <td>{{ $data->power }}</td>
                            <td>{{ $data->cost }}</td>
                            <td>
                                <a href="{{ route('cost.edit',['id' => $data->id ]) }}" class="btn btn-warning">Edit</a> | <button class="btn btn-danger" onclick="deleteCost({{ $data->id }})">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <form id="form" action="{{ route('cost.create') }}">
                <div class="row">
                    <div class="col-md-8">
                        <label class="control-label">Daya</label>
                        <input type="number" class="form-control" name="power">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label class="control-label">Tarif/Kwh</label>
                        <input type="number" class="form-control" name="cost">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <input type="submit" id="btnSubmit" class="btn btn-success" value="Simpan">
                    </div>
                </div>
            </form>
        </div>
    </div>   
@endsection