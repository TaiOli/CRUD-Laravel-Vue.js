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
        Schema::create('endereco_usuario', function (Blueprint $table) {
            $table->foreignId('endereco_id')->constrained('enderecos');
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->primary(['endereco_id', 'usuario_id']);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('endereco_usuario');
    }
};
