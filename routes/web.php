<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PagarController;
use App\Http\Controllers\VerificadorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProductosController::class, 'index']);
Route::get('/carrito', [CarritoController::class, 'index']);
Route::post('/carrito', [CarritoController::class, 'agregarProducto']);
Route::delete('/carrito', [CarritoController::class, 'quitarProducto']);
Route::post('/pagar', [PagarController::class, 'pagarProducto']);

Route::get('/verificar/{paymentToken}/{paymentID}', [VerificadorController::class, 'verificarVenta']);