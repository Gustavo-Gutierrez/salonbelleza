<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('ci')->nullable()->unique();
            $table->date('birth_date')->nullable();
            $table->enum('role', ['admin', 'empleado', 'cliente'])->default('cliente');
            $table->string('codigo_cliente')->nullable()->unique();
            $table->string('codigo_empleado')->nullable()->unique();
            $table->string('especialidad')->nullable();
            $table->string('horario')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};