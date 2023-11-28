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
        Schema::create('trabajadora', function (Blueprint $table) {
            $table->id();
            $table->integer('Ci')->nullable();
            $table->string('Especialidad')->nullable();
            $table->string('Horario')->nullable();
            $table->string('Nombre')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trabajadora');
    }
};
