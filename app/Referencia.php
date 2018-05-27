<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{
    protected $table = 'referencias';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'apellidos','domicilio','localidad','codigoPostal','provincia',
        'email','sexo','dni','telefono','fechaNacimiento','nacionalidad','intereses','compañia_origen','observaciones',
        'profesion','contacto'];}
