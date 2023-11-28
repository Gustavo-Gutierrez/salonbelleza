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
        Schema::table('recibo', function (Blueprint $table) {
            $table->foreign(['id'], 'FK_Recibo_Cita')->references(['id'])->on('cita')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id'], 'FK_Recibo_Cliente')->references(['id'])->on('cliente')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id'], 'FK_Recibo_DetalleRecibo')->references(['id'])->on('detallerecibo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id'], 'FK_Recibo_Trabajadora')->references(['id'])->on('trabajadora')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recibo', function (Blueprint $table) {
            $table->dropForeign('FK_Recibo_Cita');
            $table->dropForeign('FK_Recibo_Cliente');
            $table->dropForeign('FK_Recibo_DetalleRecibo');
            $table->dropForeign('FK_Recibo_Trabajadora');
        });
    }
};
