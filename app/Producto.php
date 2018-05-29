<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'campania', 'fecha_lanzamiento', 'fecha_vencimiento', 'coberturas',
    'observaciones', 'activo', 'id_ramo'];

    public function ramos()
    {
        return $this->belongsTo('App\Ramo','id_ramo');
    }
    public function carteras()
    {
        return $this->belongsToMany('App\Cartera','cartera_producto','id_cartera')
            ->withPivot('fecha_efecto','vencimiento','forma_pago','numero_poliza','primer_recibo_fisico',
                'observaciones');
    }
}
