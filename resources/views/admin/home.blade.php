@extends('admin.template')
@section('content')
    <h1 style="text-align:center">Selamat Datang, {{ Session::get('name') }}. Anda login sebagai {{ $level[Session::get('id_level')] }} </h1>
    <br>
    <center>
    <img src="{{ asset('images/pln.jpg') }}" width="600px">
    </center>
@endsection