<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Agenda extends Model
{
    protected $table = 'agendas';

    protected $primaryKey = 'id';

    protected $fillable = ['id_cliente', 'motivo','lugar','fecha','hora',
        'color', 'acuerdos','observaciones'];

    public function clientes()
    {
        return $this->belongsTo('App\Cliente','id_cliente');
    }
}
