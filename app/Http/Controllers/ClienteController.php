<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();
        return $clientes;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = new Cliente();
        $cliente->nombre = $request->nombre;
        $cliente->apellidos = $request->apellidos;
        $cliente->dni = $request->dni;
        $cliente->email = $request->email;
        $cliente->telefono = $request->telefono;
        $cliente->fechaNacimiento = $request->fechaNacimiento;
        $cliente->sexo = $request->sexo;
        $cliente->domicilio = $request->domicilio;
        $cliente->localidad = $request->localidad;
        $cliente->codigoPostal = $request->codigoPostal;
        $cliente->provincia = $request->provincia;
        $cliente->cuentaBancaria = $request->cuentaBancaria;
        $cliente->profesion = $request->profesion;
        $cliente->contacto = $request->contacto;
        $cliente->activo = '1';
        $cliente->id_categoria = $request->id_categoria;
        $cliente->observaciones = $request->observaciones;
        $cliente->save();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $cliente = Cliente::finfOrFail($request->id);
        $cliente->nombre = $request->nombre;
        $cliente->apellidos = $request->apellidos;
        $cliente->dni = $request->dni;
        $cliente->email = $request->email;
        $cliente->telefono = $request->telefono;
        $cliente->fechaNacimiento = $request->fechaNacimiento;
        $cliente->sexo = $request->sexo;
        $cliente->domicilio = $request->domicilio;
        $cliente->localidad = $request->localidad;
        $cliente->codigoPostal = $request->codigoPostal;
        $cliente->provincia = $request->provincia;
        $cliente->cuentaBancaria = $request->cuentaBancaria;
        $cliente->profesion = $request->profesion;
        $cliente->contacto = $request->contacto;
        $cliente->activo = '1';
        $cliente->id_categoria = $request->id_categoria;
        $cliente->observaciones = $request->observaciones;
        $cliente->save();
    }

    public function desactivar(Request $request)
    {
        $cliente = Cliente::finfOrFail($request->id);
        $cliente->activo = '0';
        $cliente->save();
    }

    public function activar(Request $request)
    {
        $cliente = Cliente::finfOrFail($request->id);
        $cliente->activo = '1';
        $cliente->save();
    }

}