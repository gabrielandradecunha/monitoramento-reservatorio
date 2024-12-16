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
        Schema::create('reservatorios', function (Blueprint $table) {
            $table->id();  // Cria o ID como chave primária
            $table->string('nome');  // Nome do reservatório
            $table->decimal('volume_maximo', 15, 2);  // Volume máximo, com 2 casas decimais
            $table->decimal('volume_atual', 15, 2);  // Volume atual, com 2 casas decimais
            $table->timestamp('ultima_atualizacao');  // Data e hora da última atualização
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // ID do usuário que criou o registro (chave estrangeira)

            $table->timestamps();  // Colunas de criação e atualização automáticas
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservatorios');
    }
};
