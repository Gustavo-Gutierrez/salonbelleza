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
        Schema::table('detallerecibo', function (Blueprint $table) {
            $table->foreign(['id'], 'FK_DetalleRecibo_Producto')->references(['id'])->on('producto')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detallerecibo', function (Blueprint $table) {
            $table->dropForeign('FK_DetalleRecibo_Producto');
        });
    }
};
