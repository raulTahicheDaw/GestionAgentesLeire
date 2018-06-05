<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use Couchbase\ClassicAuthenticator;
use Illuminate\Http\Request;
use App\Cliente;
use App\Cartera;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $clientes = Cliente::join('categorias', 'clientes.id_categoria', '=', 'categorias.id')
                ->select('clientes.id', 'clientes.nombre', 'clientes.apellidos', 'clientes.dni', 'clientes.email',
                    'clientes.telefono', 'clientes.fechaNacimiento', 'clientes.sexo', 'clientes.domicilio', 'clientes.localidad',
                    'clientes.codigoPostal', 'clientes.provincia', 'clientes.cuentaBancaria', 'clientes.profesion', 'clientes.contacto',
                    'clientes.activo', 'clientes.observaciones', 'clientes.id_categoria', 'categorias.nombre as nombre_categoria')
                ->orderBy('apellidos', 'asc')->paginate(4);
        } else {
            $clientes = Cliente::join('categorias', 'clientes.id_categoria', '=', 'categorias.id')
                ->select('clientes.id', 'clientes.nombre', 'clientes.apellidos', 'clientes.dni', 'clientes.email',
                    'clientes.telefono', 'clientes.fechaNacimiento', 'clientes.sexo', 'clientes.domicilio', 'clientes.localidad',
                    'clientes.codigoPostal', 'clientes.provincia', 'clientes.cuentaBancaria', 'clientes.profesion', 'clientes.contacto',
                    'clientes.activo', 'clientes.observaciones', 'clientes.id_categoria', 'categorias.nombre as nombre_categoria')
                ->where('clientes.' . $criterio, 'like', '%' . $buscar . '%')
                ->orderBy('apellidos', 'asc')->paginate(4);

        }
        return [
            'pagination' => [
                'total' => $clientes->total(),
                'current_page' => $clientes->currentPage(),
                'per_page' => $clientes->perPage(),
                'last_page' => $clientes->lastPage(),
                'from' => $clientes->firstItem(),
                'to' => $clientes->lastItem()
            ],
            'clientes' => $clientes
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cliente = Cliente::create([
            'id_categoria' => $request->id_categoria,
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'dni' => $request->dni,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'fechaNacimiento' => $request->fechaNacimiento,
            'sexo' => $request->sexo,
            'domicilio' => $request->domicilio,
            'localidad' => $request->localidad,
            'codigoPostal' => $request->codigoPostal,
            'provincia' => $request->provincia,
            'cuentaBancaria' => $request->cuentaBancaria,
            'profesion' => $request->profesion,
            'contacto' => $request->contacto,
            'activo' => '1',
            'observaciones' => $request->observaciones
        ]);
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
        $cliente = Cliente::findOrFail($request->id);
        $cliente->id_categoria = $request->id_categoria;
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
        $cliente->observaciones = $request->observaciones;
        $cliente->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $cliente = Cliente::findOrFail($request->id);
        $cliente->activo = '0';
        $cliente->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $cliente = Cliente::findOrFail($request->id);
        $cliente->activo = '1';
        $cliente->save();
    }

    public function listarClientes(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $clientes = Cliente::select('id', 'nombre', 'apellidos')
            ->orderBy('nombre', 'asc')
            ->get();
        return ['clientes' => $clientes];
    }

    public function listarPdf()
    {
        $clientes = Cliente::join('categorias', 'clientes.id_categoria', '=', 'categorias.id')
            ->select('clientes.id', 'clientes.nombre', 'clientes.apellidos', 'clientes.dni', 'clientes.email',
                'clientes.telefono', 'clientes.fechaNacimiento', 'clientes.sexo', 'clientes.domicilio', 'clientes.localidad',
                'clientes.codigoPostal', 'clientes.provincia', 'clientes.cuentaBancaria', 'clientes.profesion', 'clientes.contacto',
                'clientes.activo', 'clientes.observaciones', 'clientes.id_categoria', 'categorias.nombre as nombre_categoria')
            ->orderBy('apellidos', 'asc')->get();

        $cont = Cliente::count(); //Cantidad e clientes

        $pdf = \PDF::loadView('pdf.clientespdf', ['clientes' => $clientes, 'cont' => $cont]);
        return $pdf->download('clientes.pdf');
    }

    public function informeClientes(){
        $clientes = DB::table("clientes")
            ->select(DB::raw("MONTH(created_at) as mes"),DB::raw("(COUNT(id)) as total"))
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->get();
        return $clientes;
    }

    public function informeClientesMeses($desde,$hasta){
        $clientes = DB::table("clientes")
            ->whereBetween('created_at',array($desde,$hasta))
            ->select(DB::raw("MONTH(created_at) as mes"),DB::raw("(COUNT(id)) as total"))
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->get();
        return $clientes;
    }

}
