@extends('layout')

@section('title', 'Listado de clientes')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Listado de clientes</h1>
    @if (Auth::check())
        <a href="{{ route('cliente_new') }}">+ Nuevo Cliente</a>
    @endif

    @if (session('status'))
        <div>
            <strong>Success!</strong> {{ session('status') }}
        </div>
    @endif

    <table style="margin-top: 20px;margin-bottom: 10px;">
        <thead>
            <tr>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Fecha Nacimiento</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->DNI }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->apellidos }}</td>
                    <td>{{ $cliente->fechaN->format('d-m-Y') }}</td>
                    <td><img src="{{ asset('uploads/imagenes/' . $cliente->imagen) }}" alt=""></td>
                    @if (Auth::check())
                        <td>
                            <a href="{{ route('cliente_edit', ['id' => $cliente->id]) }}">Editar</a>
                            <a href="{{ route('cliente_delete', ['id' => $cliente->id]) }}">Eliminar</a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
@endsection
