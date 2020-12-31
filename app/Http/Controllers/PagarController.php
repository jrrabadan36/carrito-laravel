<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\venta;
use App\DetalleVenta;
use Session;
use Carbon\Carbon;

class PagarController extends Controller
{   
    private $mensaje;

    public function pagarProducto (Request $request) {
        if (isset($request->btnAccion) && $request->btnAccion == "Pagar") {
            $total = 0;
            $idVenta = 0;
            foreach (Session::get('CARRITO') as $clave=>$producto) { 
                $total = $total + ($producto['precio'] * $producto['cantidad']);
            }
         
            // Realizo la inserción en la tabla tblventas
            $idVenta = Venta::create([
                'ClaveTransaccion' => Session::getId(),
                'PaypalDatos' => 0,
                'Fecha' => Carbon::now()->toDateTimeString(),
                'Correo' => $request->email,
                'Total' => $total,
                'status' => 'procesado'
            ])->id;

            // Realizo la inserción en la tabla tbldetalleventa
            foreach (Session::get('CARRITO') as $clave=>$producto) {
                DetalleVenta::create([
                    'IDVENTA' => $idVenta,
                    'IDPRODUCTO' => $producto['id'],
                    'PRECIOUNITARIO' => $producto['precio'],
                    'CANTIDAD' => $producto['cantidad'],
                    'DESCARGADO' => 0
                ]);
            }
        } else {
            $this->mensaje = "Error al validar el email";
        }

        return view('carrito.pagar', ['total'=>$total, 'email'=>$request->email, 'idVenta'=>$idVenta]);
    }
}
