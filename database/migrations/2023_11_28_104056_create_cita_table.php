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
        Schema::create('cita', function (Blueprint $table) {
            $table->id();
            $table->date('Fecha')->nullable();
            $table->time('Hora')->nullable();
            
            $table->integer('ClienteID')->index('FK_Cita_Cliente');
            $table->integer('TrabajadoraID')->index('FK_Cita_Trabajadora');
            $table->integer('Detalle_citaID')->nullable()->index('FK_Cita_Detalle_cita');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cita');
    }
};
