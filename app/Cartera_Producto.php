<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartera_Producto extends Model
{
    protected $table = 'cartera_producto';

    protected $primaryKey = 'id';

    protected $fillable = ['id_cartera', 'id_producto','fecha_efecto','vencimiento','forma_pago',
        'numero_poliza', 'primer_recibo_fisico','observaciones'];

    public $timestamps = false;
}
