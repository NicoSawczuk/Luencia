<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Prenda extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    //Relaciones
    public function vendedora(){
        return $this->belongsTo(Vendedora::class, 'vendedora_id');
    }

    public function venta(){
        return $this->belongsTo(Venta::class, 'venta_id');
    }
}
