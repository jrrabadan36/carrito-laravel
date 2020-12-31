<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductosController extends Controller
{
    public function index() {
        return view("index", ["productos"=>Producto::all()]);
    }
}
