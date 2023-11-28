<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detalle_cita', function (Blueprint $table) {
            $table->foreign(['id'], 'FK_Detalle_cita_Servicio')->references(['id'])->on('servicio')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detalle_cita', function (Blueprint $table) {
            $table->dropForeign('FK_Detalle_cita_Servicio');
        });
    }
};
