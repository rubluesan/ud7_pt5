@extends('layout')

@section('title', 'Home')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div>
        <img src="{{ asset('img/logo.png') }}" alt="">
        <h2>UD7 Pt4</h2>
        <hr>
        <h3>Modelo Vista Controlador. Uso framework (4)</h3>
    </div>
@endsection
