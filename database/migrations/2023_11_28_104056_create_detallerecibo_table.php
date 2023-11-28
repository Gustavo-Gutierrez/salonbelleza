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
        Schema::create('detallerecibo', function (Blueprint $table) {
            $table->id();
            $table->integer('Cantidad')->nullable();
            $table->integer('Descuento')->nullable();
            $table->decimal('Precio_unitario', 5)->nullable();
        
            $table->integer('ProductoID')->nullable()->index('FK_DetalleRecibo_Producto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detallerecibo');
    }
};
