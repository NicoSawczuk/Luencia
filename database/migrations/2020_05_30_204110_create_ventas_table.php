<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->date('fecha_venta');
            $table->float('monto_venta')->default(0);

            $table->unsignedBigInteger('vendedora_id');
            $table->foreign('vendedora_id')->references('id')->on('vendedoras'); 
            $table->unsignedBigInteger('prenda_id');
            $table->foreign('prenda_id')->references('id')->on('prendas'); 

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
