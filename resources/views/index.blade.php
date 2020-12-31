@extends('layout.main')

@section('titulo')
    Listado de productos
@endsection

@section('contenido')
    @isset($mensaje)
        <div class="alert alert-success" role="alert">
            {{ $mensaje }}<a href="{{ url('/carrito') }}"><span class="badge badge-success">Ir al carrito</span></a>
        </div>
    @endisset
    <div class="row">
        @foreach ($productos as $producto)
            <div class="col-3">
                <div class="card">
                    <img class="card-img-top" src="{{ $producto->Imagen }}" alt="{{ $producto->Nombre }}" height="317px">
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->Nombre }}</h5>
                        <p class="card-text">Descripción</p>

                        <form action = "{{ url('carrito') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ encrypt($producto->ID) }}">
                            <input type="hidden" name="nombre" id="nombre" value="{{ encrypt($producto->Nombre) }}">
                            <input type="hidden" name="precio" id="precio" value="{{ encrypt($producto->Precio) }}">
                            <input type="hidden" name="cantidad" id="cantidad" value="{{ encrypt(1) }}">
                            <input type="submit" class="btn btn-primary" name="btnAccion" id="agregar" value="Agregar">
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection