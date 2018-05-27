<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/');
        }
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if ($buscar == '') {
            $productos = Producto::join('ramos', 'productos.id_ramo', '=', 'ramos.id')
                ->select('productos.id', 'productos.nombre', 'productos.campania', 'productos.fecha_lanzamiento', 'productos.fecha_vencimiento',
                    'productos.coberturas', 'productos.observaciones','productos.activo', 'productos.id_ramo', 'ramos.nombre as nombre_ramo')
                ->orderBy('nombre', 'asc')->paginate(4);
        } else {
            $productos = Producto::join('ramos', 'productos.id_categoria', '=', 'ramos.id')
                ->select('productos.id', 'productos.nombre', 'productos.campania', 'productos.fecha_lanzamiento', 'productos.fecha_vencimiento',
                    'productos.coberturas', 'productos.observaciones','productos.activo', 'productos.id_ramo', 'ramos.nombre as nombre_ramo')
                ->where('productos.' . $criterio, 'like', '%' . $buscar . '%')
                ->orderBy('nombre', 'asc')->paginate(4);

        }
        return [
            'pagination' => [
                'total' => $productos->total(),
                'current_page' => $productos->currentPage(),
                'per_page' => $productos->perPage(),
                'last_page' => $productos->lastPage(),
                'from' => $productos->firstItem(),
                'to' => $productos->lastItem()
            ],
            'productos' => $productos
        ];
    }

    public function listarProductos(Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/');
        }
        $productos = Producto::where('activo', '=', '1')
            ->select('id', 'nombre')->orderBy('nombre', 'asc')
            ->get();

        return ['productos' => $productos];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/');
        }
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->campania = $request->campania;
        $producto->fecha_lanzamiento = $request->fecha_lanzamiento;
        $producto->fecha_vencimiento = $request->fecha_vencimiento;
        $producto->coberturas = $request->coberturas;
        $producto->observaciones = $request->observaciones;
        $producto->id_ramo = $request->id_ramo;
        $producto->activo = '1';
        $producto->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/');
        }
        $producto = Producto::findOrFail($request->id);
        $producto->nombre = $request->nombre;
        $producto->campania = $request->campania;
        $producto->fecha_lanzamiento = $request->fecha_lanzamiento;
        $producto->fecha_vencimiento = $request->fecha_vencimiento;
        $producto->coberturas = $request->coberturas;
        $producto->observaciones = $request->observaciones;
        $producto->id_ramo = $request->id_ramo;
        $producto->activo = '1';
        $producto->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/');
        }

        $producto = Producto::findOrFail($request->id);
        $producto->activo = '0';
        $producto->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/');
        }

        $producto = Producto::findOrFail($request->id);
        $producto->activo = '1';
        $producto->save();
    }
}
