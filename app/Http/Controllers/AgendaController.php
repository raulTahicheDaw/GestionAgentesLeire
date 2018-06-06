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
            $title = $cita->hora . "-" . $this->recuperaNombre($cita->id_cliente);
            $citaMontada = array('id' => $cita->id, 'title' => $title, 'startDate' => $cita->fecha);
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
        $cita->fecha = $request->fecha;
        $cita->acuerdos = $request->acuerdos;
        $cita->observaciones = $request->observaciones;
        $cita->hora = $request->hora;
        $cita->save();
    }

    public function recuperaCita(Request $request)
    {
        $cita = Agenda::where('id', $request->id)->first();
        $cita['nombre'] = $this->recuperaNombre($cita->id_cliente);
        return $cita;
    }

    public function citasHoy($fecha)
    {
        $citasDia = Agenda::where('fecha',$fecha)->select('id','hora','id_cliente','motivo','lugar','observaciones')
            ->orderBy('hora','asc')->get();
        foreach ($citasDia as $c){
            $c['nombre'] = $this->recuperaNombre($c->id_cliente);
        }
        return $citasDia;
    }

    public function eliminar(Request $request){
        if (!$request->ajax()) return redirect('/');
        $cita = Agenda::findOrFail($request->id);
        $cita->delete();
    }
}
