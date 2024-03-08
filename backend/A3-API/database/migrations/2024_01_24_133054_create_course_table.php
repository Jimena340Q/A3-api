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
        Schema::create('course', function (Blueprint $table) {
            $table->id();
            $table->integer('code')->unique()->comment('codigo de ficha');
            $table->string('shift')->comment('jornada');
            $table->foreignId('career_id')->constrained('career')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->date('initial_date')->comment('fecha inicial');
            $table->date('final_date')->comment('fecha final');
            $table->string('status')->comment('etapa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course');
    }
};
