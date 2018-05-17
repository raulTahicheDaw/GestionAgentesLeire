<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $categorias = Categoria::orderBy('id', 'desc')->paginate(5);
        } else {
            $categorias = Categoria::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'asc')->paginate(6);
        }
        return [
            'pagination' => [
                'total' => $categorias->total(),
                'current_page' => $categorias->currentPage(),
                'per_page' => $categorias->perPage(),
                'last_page' => $categorias->lastPage(),
                'from' => $categorias->firstItem(),
                'to' => $categorias->lastItem()
            ],
            'categorias' => $categorias
        ];
    }
    public function listarCategorias(Request $request){
        if (!$request->ajax()) return redirect('/');
        $categorias = Categoria::where('activo','=','1')
        ->select('id','nombre')->orderBy('nombre','asc')
        ->get();
        return ['categorias' =>$categorias];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->activo = '1';
        $categoria->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $categoria = Categoria::findOrFail($request->id);
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        
        $categoria->activo = '1';
        $categoria->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $categoria = Categoria::findOrFail($request->id);
        $categoria->activo = '0';
        $categoria->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $categoria = Categoria::findOrFail($request->id);
        $categoria->activo = '1';
        $categoria->save();
    }
}
