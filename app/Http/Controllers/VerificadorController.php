<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Venta;
use Session;

class VerificadorController extends Controller
{
    public function verificarVenta (Request $request) { 
        $cliente = new Client();
        $respuesta = $cliente->request('POST', env('URLPAYPAL').'/v1/oauth2/token', [
                    'headers' =>
                        [
                            'Accept' => 'application/json',
                            'Accept-Language' => 'es-ES',
                            'Content-Type' => 'application/x-www-form-urlencoded',
                        ],
                    'body' => 'grant_type=client_credentials',
                    'auth' => [env('CLIENTIDPAYPAL'), env('SECRETPAYPAL'), 'basic'
                ]
            ]
        );

        $data = json_decode($respuesta->getBody(), true);
        $access_token = $data['access_token'];
        // var_export($access_token); 

        $respuestaVenta  = $cliente->request('GET', env("URLPAYPAL").'/v1/payments/payment/'.$request->paymentID, [
                'headers' => 
                    [
                        'Content-Type' => 'application/json',
                        'Authorization' => "Bearer $access_token",
                    ]
        ]);
        $objDatosTransaccion = json_decode($respuestaVenta->getBody()->getContents()); // Lo conbierto de json a objeto para obtener la información
        // var_export($objDatosTransaccion); 
        
        $state = $objDatosTransaccion->state;
        $email = $objDatosTransaccion->payer->payer_info->email;

        $total = $objDatosTransaccion->transactions[0]->amount->total;
        $currency = $objDatosTransaccion->transactions[0]->amount->currency;
        $custom = $objDatosTransaccion->transactions[0]->custom;

        $clave = explode("#", $custom);

        $SID = $clave[0];
        $claveVenta = decrypt($clave[1]);

        if ($state == "approved") {
            $venta = Venta::find($claveVenta);
            $venta->PaypalDatos = $respuestaVenta->getBody()->getContents();
            $venta->status = 'aprobado';
            $venta->save();
            $mensajePaypal = "Pago aprobado.";

            $venta = Venta::where('ClaveTransaccion', '=', $SID)
                            ->where('Total', '=', $total)
                            ->where('ID', '=', $claveVenta)
                            ->first();
            $venta->status = 'completo';
            $venta->save();
            $mensajePaypal = "Pago completado.";
            
            Session::flush();
        } else {
            $mensajePaypal = "Hay un problema con el pago de PayPal.";
        }  
        
        return view('carrito.verificar', ['mensajePaypal'=>$mensajePaypal]);
    }
}
