<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Vendedora extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    //Relaciones
    public function prendas(){
        return $this->hasMany(Prenda::class);
    }

    public function ventas(){
        return $this->hasMany(Venta::class);
    }
}
