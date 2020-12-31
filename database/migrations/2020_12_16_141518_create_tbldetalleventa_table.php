<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbldetalleventaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbldetalleventa', function (Blueprint $table) {
            $table->integer('ID', true);
            $table->integer('IDVENTA')->index('IDVENTA');
            $table->integer('IDPRODUCTO')->index('IDPRODUCTO');
            $table->decimal('PRECIOUNITARIO', 20);
            $table->integer('CANTIDAD');
            $table->integer('DESCARGADO');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbldetalleventa');
    }
}
