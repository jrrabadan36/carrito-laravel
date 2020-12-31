@extends ('layout.main')

@section ('titulo')
    Pagar
@endsection

@section ('contenido')
    <div class="jumbotron text-center">
        <h1 class="display-4">¡Ya casi has finalizado!</h1>
        <p class="lead" data-total="{{ isset($total) ? number_format($total, 2) : '' }}" data-id="{{ \Session::getId() }}" data-idVenta="{{ isset($idVenta) ? encrypt($idVenta) : '' }}">Estas dispuesto a efectuar una compra por importe de:<h2> {{ number_format($total, 2) }}€</h2></p>
        <div id="paypal-button-container"></div>
        <hr class="my-4">
        <p>Se va a realizar una compra a adjuntada a la cuenta:<b> {{ $email }}</b></p>
    </div>
@endsection