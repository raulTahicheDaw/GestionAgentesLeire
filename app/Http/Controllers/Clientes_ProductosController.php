<?php

namespace App\Http\Controllers;

use App\Clientes_Productos;
use App\Producto;
use Illuminate\Http\Request;
use App\Cliente;
use Illuminate\Support\Facades\DB;

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
    private function obtieneNombreCliente($id_cliente){
        $cliente = Cliente::find($id_cliente);
        return $cliente->nombre;
    }


    public function listarVencimientos($desde,$hasta){
        $vencimientos = Clientes_Productos::whereBetween('vencimiento',array($desde, $hasta))->get();
        foreach ($vencimientos as $vencimiento) {
            $nombreCliente = $this->obtieneNombreCliente($vencimiento->id_cliente);
            $nombreProducto = $this->recuperaNombreProducto($vencimiento->id_producto);
            $vencimiento['nombreCliente']=$nombreCliente;
            $vencimiento['nombreProducto']= $nombreProducto;
        }
        return $vencimientos;
    }

    public function informes(){
        $productos = DB::table('clientes_productos')
            ->select('id_producto', DB::raw('count(*) as total'))
            ->groupBy('id_producto')
            ->get();
        return $productos;
    }
}
