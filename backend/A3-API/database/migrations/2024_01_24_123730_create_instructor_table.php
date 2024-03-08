<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('instructor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document')->unique()->comment('cédula');
            $table->string('fullname')->comment('nombre completo');
            $table->string('sena_email')->unique()->comment('correo sena');
            $table->string('personal_email')->unique()->comment('correo personal');
            $table->string('phone', 30)->nullable()->comment('teléfono');
            $table->string('password')->comment('contraseña');
            $table->string('type', 20)->comment('tipo contrato');
            $table->string('profile')->comment('perfil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructor');
    }
};
