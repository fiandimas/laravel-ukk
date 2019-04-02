@extends('customer.template')
@section('content')
    <h1 style="text-align:center">Selamat Datang, {{ Session::get('name') }}. Anda login sebagai pelanggan </h1>
    <br>
    <center>
    <img src="{{ asset('images/pln.jpg') }}" width="600px">
    </center>
@endsection