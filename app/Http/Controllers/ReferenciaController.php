<?php

namespace App\Http\Controllers;

use App\Referencia;
use Illuminate\Http\Request;

class ReferenciaController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $referencias = Referencia::orderBy('nombre', 'asc')->paginate(7);
        } else {
            $referencias = Referencia::where('referencia.'.$criterio, 'like', '%' . $buscar . '%')
                ->orderBy('nombre', 'asc')->paginate(7);

        }
        return [
            'pagination' => [
                'total'         => $referencias->total(),
                'current_page'  => $referencias->currentPage(),
                'per_page'      => $referencias->perPage(),
                'last_page'     => $referencias->lastPage(),
                'from'          => $referencias->firstItem(),
                'to'            => $referencias->lastItem()
            ],
            'referencias' => $referencias
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $referencia = new Referencia();
        $referencia->nombre = $request->nombre;
        $referencia->apellidos = $request->apellidos;
        $referencia->domicilio = $request->domicilio;
        $referencia->localidad = $request->localidad;
        $referencia->codigoPostal = $request->codigoPostal;
        $referencia->provincia = $request->provincia;
        $referencia->email = $request->email;
        $referencia->sexo = $request->sexo;
        $referencia->dni = $request->dni;
        $referencia->telefono = $request->telefono;
        $referencia->fechaNacimiento = $request->fechaNacimiento;
        $referencia->nacionalidad = $request->nacionalidad;
        $referencia->intereses = $request->intereses;
        $referencia->compañia_origen = $request->compañia_origen;
        $referencia->observaciones = $request->observaciones;
        $referencia->profesion = $request->profesion;
        $referencia->contacto = $request->contacto;
        $referencia->activo = '1';
        $referencia->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $referencia = Referencia::findOrFail($request->id);
        $referencia->nombre = $request->nombre;
        $referencia->apellidos = $request->apellidos;
        $referencia->domicilio = $request->domicilio;
        $referencia->localidad = $request->localidad;
        $referencia->codigoPostal = $request->codigoPostal;
        $referencia->provincia = $request->provincia;
        $referencia->email = $request->email;
        $referencia->sexo = $request->sexo;
        $referencia->dni = $request->dni;
        $referencia->telefono = $request->telefono;
        $referencia->fechaNacimiento = $request->fechaNacimiento;
        $referencia->nacionalidad = $request->nacionalidad;
        $referencia->intereses = $request->intereses;
        $referencia->compañia_origen = $request->compañia_origen;
        $referencia->observaciones = $request->observaciones;
        $referencia->profesion = $request->profesion;
        $referencia->contacto = $request->contacto;
        $referencia->activo = '1';
        $referencia->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $referencia = Referencia::findOrFail($request->id);
        $referencia->activo = '0';
        $referencia->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $referencia = Referencia::findOrFail($request->id);
        $referencia->activo = '1';
        $referencia->save();
    }
}
