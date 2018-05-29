<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cartera;
use App\Cliente;

class CarteraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cartera = Cliente::join('clientes', 'cartera.id_cliente', '=', 'clientes.id')
        ->where('cartera.id_cliente','=',$request->id_cliente);
        return $cartera;
    }

    public function crearCartera($id_cliente)
    {
        $cartera = new Cartera();
        $cartera->save();
    }
}
