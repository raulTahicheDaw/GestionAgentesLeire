<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{

    protected $table = 'categorias';

    protected $primaryKey = 'id';

    protected $fillable = ['nombre', 'descripcion','activo'];

    public function clientes(){
        return $this->hasMany('App\Cliente');
    }
}
