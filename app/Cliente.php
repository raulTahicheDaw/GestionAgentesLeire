<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'apellidos','dni','email','telefono','fechaNacimiento','sexo','domicilio','localidad',
        'codigoPostal','provincia','cuentaBancaria','profesion','contacto','activo','id_categoria','observaciones'];

    public function categorias(){
        return $this->belongsTo('App\Categoria','id_categoria');
    }
    public function agendas()
    {
        return $this->hasMany('App\Agenda','cliente_id');
    }
    public function carteras()
    {
        return $this->hasOne('\App\Cartera','cliente_id');
    }
}
