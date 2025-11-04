<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')
                  ->constrained('usuarios') // Se enlaza a la tabla 'usuarios'
                  ->onDelete('cascade');     // Si se borra el usuario, se borran sus categorías
            
            $table->string('nombre');
            $table->string('color'); // Ej. #C4B5FD
            $table->timestamps(); // Crea created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
