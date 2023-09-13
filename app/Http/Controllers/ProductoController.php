<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function listar() {
        $productos=Producto::all(); // Eloquent
        return view("listar",['productos'=>$productos]);
    }
}
