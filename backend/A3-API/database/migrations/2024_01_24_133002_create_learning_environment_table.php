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
        Schema::create('learning_environment', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->comment('nombre');
            $table->integer('capacity')->nullable()->comment('capacidad');
            $table->integer('area_mt2')->nullable()->comment('area en mt2');
            $table->string('floor', 1)->comment('piso');
            $table->string('inventory')->comment('inventario');
            $table->foreignId('type_id')->constrained('environment_type')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('location_id')->constrained('location')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->string('status', 20)->comment('estado: ACTIVO, INACTIVO');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_environment');
    }
};
