<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use Session;

class CarritoController extends Controller
{
    private $mensaje;

    public function index() { 
        return view('carrito.index', ['listaProductos'=>Session::get('CARRITO')]);
    }

    public function agregarProducto(Request $request) {  // Session::flush();
        if (isset($request->btnAccion) && $request->btnAccion == 'Agregar') {
            $id = decrypt($request->id);
            $nombre = decrypt($request->nombre);
            $precio = decrypt($request->precio);
            $cantidad = decrypt($request->cantidad);
            
            $sesionCarrito = array();

            if (!empty(Session::all())) {
                $sesionCarrito = array(
                    'id'        => $id,
                    'nombre'    => $nombre,
                    'precio'    => $precio,
                    'cantidad'  => $cantidad
                );
            } else {
                $this->mensaje = "No hay productos en el carrito.";
            }

            Session::push('CARRITO', $sesionCarrito);
            $this->mensaje = "Producto agregado correctamente...";

        } else {
            $this->mensaje = "Error al agregar el producto";
        }
    
        return view("index", ["productos"=>Producto::all(), "mensaje"=>$this->mensaje]);
    }

    public function quitarProducto(Request $request) { // Session::flush();
        if (isset($request->btnAccion) && $request->btnAccion == 'Quitar') {
            $id = decrypt($request->id);
            
            foreach (Session::get('CARRITO') as $indice=>$producto) {
                if ($producto['id'] == $id) {
                    $carrito = Session::get('CARRITO');
                    unset($carrito[$indice]);
                    Session::put('CARRITO', $carrito);
                    $this->mensaje = "Producto eliminado del carrito";
                    break;
                }
            }
        } else {
            $this->mensaje = "Error al quitar el producto";
        }
        
        return view('carrito.index', ['listaProductos'=>Session::get('CARRITO'), 'mensaje'=>$this->mensaje]);
    }
}
