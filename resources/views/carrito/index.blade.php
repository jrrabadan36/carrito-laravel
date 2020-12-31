@extends ('layout.main')

@section ('titulo')
    Carito de compra
@endsection

@section ('contenido')
    @isset ($mensaje)
        <div class="alert alert-success" role="alert">
            {{ $mensaje }}
        </div>
    @endisset
    @if (!empty($listaProductos))
        <?php $total = 0; ?>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listaProductos as $producto)
                    <tr>
                        <td>{{ $producto['id'] }}</td>
                        <td>{{ $producto['nombre'] }}</td>
                        <td>{{ $producto['precio'] }}</td>
                        <td>{{ $producto['cantidad'] }}</td>
                        <td>
                            <form action="{{ url('carrito') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ encrypt($producto['id']) }}">
                                <input class="btn btn-danger" type="submit" name="btnAccion" id="quitar" value="Quitar">
                            </form>
                        </td>
                    </tr>
                    <?php $total = $total + ($producto['precio'] * $producto['cantidad']); ?>
                @endforeach
                <tr>
                    <td colspan="3" align="right"><h3>Total</h3></td>
                    <td align="right"><h3>${{ number_format($total, 2) }}</h3></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="5">
                        <div class="alert alert-success" role="alert">
                            <form action="{{ url('pagar') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Introduzca el email</label>
                                    <input class="form-control" type="email" name="email" id="email" required><br>
                                    <input class="btn btn-primary btn-lg btn-block" type="submit" name="btnAccion" value="Pagar">
                                </div>
                                <smal id="emailHelp" class="form-text text-muted">Los productos se enviarán a este correo.</small>
                            </form>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    @else
        <div class="jumbotron text-center">
            <h1 class="display-4">No hay productos en el carrito.</h1>
            <p class="lead">Productos({{ count(\Session::get('CARRITO')) }})</p>
            <hr class="my-4">
            <p>Para ir al Home pincha <a href="{{ url('/') }}">aquí</a></p>
        </div>
    @endif
@endsection