<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblventasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblventas', function (Blueprint $table) {
            $table->integer('ID', true);
            $table->string('ClaveTransaccion', 250);
            $table->text('PaypalDatos');
            $table->dateTime('Fecha');
            $table->string('Correo', 5000);
            $table->decimal('Total', 60);
            $table->string('status', 200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblventas');
    }
}
