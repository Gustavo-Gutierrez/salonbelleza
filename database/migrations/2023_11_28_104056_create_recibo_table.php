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
        Schema::create('recibo', function (Blueprint $table) {
            $table->id();
            $table->date('Fecha')->nullable();
            $table->decimal('Total', 5)->nullable();
            
            $table->integer('CitaID')->index('FK_Recibo_Cita');
            $table->integer('ClienteID')->index('FK_Recibo_Cliente');
            $table->integer('DetalleReciboID')->nullable()->index('FK_Recibo_DetalleRecibo');
            $table->integer('TrabajadoraID')->index('FK_Recibo_Trabajadora');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recibo');
    }
};
