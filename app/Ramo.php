<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ramo extends Model
{
    protected $fillable = ['nombre','descripcion','activo'];

    public function producto()
    {
        return $this->hasMany('App\Producto');
    }
}
