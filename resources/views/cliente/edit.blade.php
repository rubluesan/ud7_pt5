@extends('layout')

@section('title', 'Editar Cliente')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Editar Cliente</h1>
    <a href="{{ route('cliente_list') }}">&laquo; Volver</a>

    @if ($errors->any())
        <div style="color: red">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="margin-top: 20px">
        <form method="POST" enctype="multipart/form-data" action="{{ route('cliente_edit', ['id' => $cliente->id]) }}">
            @csrf
            <div>
                <label for="DNI">DNI</label>
                <input type="text" name="DNI" value="{{ $cliente->DNI }}" />
            </div>
            <div>
                <label for="saldo">Nombre</label>
                <input type="text" name="nombre" value="{{ $cliente->nombre }}" />
            </div>
            <div>
                <label for="saldo">Apellidos</label>
                <input type="text" name="apellidos" value="{{ $cliente->apellidos }}" />
            </div>
            <div>
                <label for="saldo">Fecha Nacimiento</label>
                <input type="date" name="fechaN" value="{{ $cliente->fechaN->format('Y-m-d') }}" />
            </div>
            <div>
                @if ($cliente->imagen)
                    <div>
                        <p>Imagen actual: <strong>{{ $cliente->imagen }}</strong></p>
                        <p>Eliminar imagen: <input type="checkbox" name="borrarImagen"></p>
                    </div>
                @endif
                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" />
            </div>
            <br>
            <button type="submit">Editar Cliente</button>
        </form>
    </div>
@endsection
