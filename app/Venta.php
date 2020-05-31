<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Venta extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    //Relaciones
    public function vendedora(){
        return $this->belongsTo(Vendedora::class, 'vendedora_id');
    }

    public function prendas(){
        return $this->hasMany(Prenda::class, 'id');
    }

}
