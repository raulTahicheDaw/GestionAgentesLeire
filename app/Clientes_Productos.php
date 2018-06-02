<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes_Productos extends Model
{
    protected $table = 'clientes_productos';
    protected $primaryKey  ='id';
    protected $fillable = ['id_cliente','id_producto','fecha_efecto','vencimiento','forma_pago','numero_poliza',
        'primer_recibo_fisico','observaciones'];
    public $timestamps = false;
}
