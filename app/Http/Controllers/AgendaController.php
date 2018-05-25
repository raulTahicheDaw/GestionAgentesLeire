<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agenda;
use DateTime;
use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
{
    private function recuperaNombre($id){
        $clientes = DB::table('clientes')->select('id','nombre','apellidos')->get();
        foreach ($clientes as $cliente){
            if($cliente->id==$id){
                return $cliente->nombre . " " . $cliente->apellidos;
            }
        }
    }

    public function index()
    {
        $arrayResultado = [];
        $data = Agenda::all();
        foreach ($data as $cita) {
            $citaMontada = array('id' => $cita->id, 'title' => $this->recuperaNombre($cita->id_cliente), 'startDate' => $cita->fecha);
            $arrayResultado[] = $citaMontada;
        }
        return $arrayResultado;
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cita = new Agenda();
        $cita->id_cliente = $request->id_cliente;
        $cita->motivo = $request->motivo;
        $cita->lugar = $request->lugar;
        $cita->color = $request->color;
        $cita->fecha = $request->fecha;
        $cita->acuerdos = $request->acuerdos;
        $cita->observaciones = $request->observaciones;
        $cita->save();
    }

    public function recuperaCita(Request $request)
    {
        $cita = Agenda::where('id', $request->id)->get();
        foreach ($cita as $citas){
            $citas['nombre'] = $this->recuperaNombre($citas->id_cliente);
        }
        return $cita;
    }

    public function addEvento(Request $request)
    {

    }
}
