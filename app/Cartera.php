<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartera extends Model
{
    protected $table = 'carteras';

    protected $primaryKey = 'id';

    protected $fillable = ['id_cliente'];


    public function clientes()
    {
        return $this->hasOne('App\Cliente','id_cliente');
    }
    public function productos()
    {
        return $this->belongsToMany('App\Producto','cartera_producto','id_producto')
            ->withPivot('fecha_efecto','vencimiento','forma_pago','numero_poliza','primer_recibo_fisico',
                'observaciones');
    }
}
