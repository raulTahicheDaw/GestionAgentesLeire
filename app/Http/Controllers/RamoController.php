<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ramo;


class RamoController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $ramos = Ramo::orderBy('id', 'desc')->paginate(4);
        } else {
            $ramos = Ramo::where($criterio, 'like', '%' . $buscar . '%')
                ->orderBy('id', 'asc')->paginate(4);
        }
        return [
            'pagination' => [
                'total' => $ramos->total(),
                'current_page' => $ramos->currentPage(),
                'per_page' => $ramos->perPage(),
                'last_page' => $ramos->lastPage(),
                'from' => $ramos->firstItem(),
                'to' => $ramos->lastItem()
            ],
            'ramos' => $ramos
        ];
    }

    public function listarRamos(Request $request){
        if (!$request->ajax()) return redirect('/');
        $ramos = Ramo::where('activo','=','1')
        ->select('id','nombre')->orderBy('nombre','asc')
        ->get();
        return ['ramos' =>$ramos];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $ramo = new Ramo();
        $ramo->nombre = $request->nombre;
        $ramo->descripcion = $request->descripcion;
        $ramo->activo = '1';
        $ramo->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $ramo = Ramo::findOrFail($request->id);
        $ramo->nombre = $request->nombre;
        $ramo->descripcion = $request->descripcion;
        
        $ramo->activo = '1';
        $ramo->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $ramo = Ramo::findOrFail($request->id);
        $ramo->activo = '0';
        $ramo->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $ramo = Ramo::findOrFail($request->id);
        $ramo->activo = '1';
        $ramo->save();
    }
}
