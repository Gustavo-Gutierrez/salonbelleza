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
        Schema::table('cita', function (Blueprint $table) {
            $table->foreign(['id'], 'FK_Cita_Cliente')->references(['id'])->on('cliente')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id'], 'FK_Cita_Detalle_cita')->references(['id'])->on('detalle_cita')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id'], 'FK_Cita_Trabajadora')->references(['id'])->on('trabajadora')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cita', function (Blueprint $table) {
            $table->dropForeign('FK_Cita_Cliente');
            $table->dropForeign('FK_Cita_Detalle_cita');
            $table->dropForeign('FK_Cita_Trabajadora');
        });
    }
};
