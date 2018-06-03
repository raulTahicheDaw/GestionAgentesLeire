<?php

namespace App\Http\Controllers;

use App\Clientes_Productos;
use App\Producto;
use Illuminate\Http\Request;

class Clientes_ProductosController extends Controller
{

    public function addProducto(Request $request)
    {
        $producto = new Clientes_Productos();
        $producto->id_cliente = $request->id_cliente;
        $producto->id_producto = $request->id_producto;
        $producto->fecha_efecto = $request->fechaEfecto;
        $producto->vencimiento = $request->fechaVencimiento;
        $producto->forma_pago = $request->formaPago;
        $producto->numero_poliza = $request->numeroPoliza;
        $producto->primer_recibo_fisico = $request->rFisico;
        $producto->observaciones = $request->observacionesProducto;
        $producto->save();
    }
    private function recuperaNombreProducto($id_producto){
        $nombreProducto = Producto::find($id_producto);
        return $nombreProducto->nombre;
    }

    public function listarProductosClientes($id_cliente){
        $productos = Clientes_Productos::where('id_cliente',$id_cliente)->get();
        foreach ($productos as $p){
            $p['nombre_producto'] = $this->recuperaNombreProducto($p->id);
        }
        return $productos;
    }

    public function listarVencimientos($desde,$hasta){
        $vencimientos = Clientes_Productos::whereBetween('vencimiento',array($desde, $hasta))->get();
        return $vencimientos;
    }
}
