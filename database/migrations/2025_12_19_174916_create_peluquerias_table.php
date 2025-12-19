<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

   public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id('id_cita');
            $table->string('nombre_clienta', 100);
            $table->string('telefono', 20);
            $table->string('servicio', 100);
            $table->date('fecha_cita');
            $table->time('hora_cita');
            $table->enum('estado', ['pendiente', 'completada', 'cancelada'])->default('pendiente');
            $table->timestamps(); 
            
            $table->index('fecha_cita');
            $table->index('estado');
            
            $table->unique(['fecha_cita', 'hora_cita']);
        });
    
 }

   public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
