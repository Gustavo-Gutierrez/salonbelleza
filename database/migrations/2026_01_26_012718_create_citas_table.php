<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin')->nullable();
            $table->enum('estado', ['pendiente', 'confirmada', 'en_proceso', 'completada', 'cancelada'])->default('pendiente');
            $table->text('notas')->nullable();
            $table->decimal('total', 10, 2)->default(0);
            $table->decimal('descuento', 10, 2)->default(0);
            $table->decimal('total_final', 10, 2)->default(0);
            
            // Relaciones
            $table->foreignId('cliente_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('empleado_id')->constrained('users')->onDelete('cascade');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};