<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldConfiguracion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tarifas', function (Blueprint $table) {
            //
            $table->unsignedInteger('configuracion_id');
            $table->foreign('configuracion_id')->references('id')->on('configuracion_tiempos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tarifas', function (Blueprint $table) {
            //
            $table->dropForeign('configuracion_id');
            $table->dropColumn('configuracion_id');
        });
    }
}
