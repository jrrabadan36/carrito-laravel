@extends ('layout.main')

@section ('titulo')
    Verificar pago
@endsection

@section ('contenido')
    <div class="jumbotron text-center">
        <h1 class="display-4">¡ {{ $mensajePaypal }} !</h1>
        <p class="lead"></p>
        <hr class="my-4">
        <p>Se vha completado el pago de manera satisfactoria, si desea comprar mas productos visite el catalogo pulsando <a href="{{ url('/') }}">aquí</a></b></p>
    </div>
@endsection