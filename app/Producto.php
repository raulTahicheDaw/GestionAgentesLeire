<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'campania', 'fecha_lanzamiento', 'fecha_vencimiento', 'coberturas',
    'observaciones', 'activo', 'id_ramo'];

    public function ramo()
    {
        return $this->belongsTo('App\Ramo');
    }
}
