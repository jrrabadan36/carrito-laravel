<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbldetalleventaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbldetalleventa', function (Blueprint $table) {
            $table->foreign('IDVENTA', 'tbldetalleventa_ibfk_1')->references('ID')->on('tblventas')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('IDPRODUCTO', 'tbldetalleventa_ibfk_2')->references('ID')->on('tblproductos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbldetalleventa', function (Blueprint $table) {
            $table->dropForeign('tbldetalleventa_ibfk_1');
            $table->dropForeign('tbldetalleventa_ibfk_2');
        });
    }
}
