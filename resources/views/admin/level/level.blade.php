@extends('admin.template')
@section('content')
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Level</th>
                </tr>
            </thead>
            <tbody>
                @foreach($level as $data)
                <tr>
                    <td>{{ ++$loop->index }}</td>
                    <td>{{ $data->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection