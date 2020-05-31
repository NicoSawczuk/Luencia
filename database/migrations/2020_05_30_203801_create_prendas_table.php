<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prendas', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('detalle');
            $table->string('color');
            $table->float('precio_original')->default(0);
            $table->float('precio_venta')->default(0);
            $table->string('genero');

            $table->unsignedBigInteger('vendedora_id');
            $table->foreign('vendedora_id')->references('id')->on('vendedoras');            
            
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
        Schema::dropIfExists('prendas');
    }
}
