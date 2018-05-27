<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'apellidos','dni','email','telefono','fechaNacimiento','sexo','domicilio','localidad',
        'codigoPostal','provincia','cuentaBancaria','profesion','contacto','activo','id_categoria','observaciones'];
    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }
    public function agenda()
    {
        return $this->belongsToMany('App\Agenda');
    }
}
