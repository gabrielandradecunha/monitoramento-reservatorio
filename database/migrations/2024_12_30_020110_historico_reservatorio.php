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
        Schema::create('historico_reservatorios', function (Blueprint $table) {
            $table->id();
            /* o motivo para o elemento reservatorio_id não ser uma chave
            estrangeira é para garantir que o historico se mantenha mesmo após
            a entidade ser movida para a tabela lixeira, e só seja deletado de fato
            após a entidade ser deletada diretamente na lixeira */
            $table->unsignedBigInteger('reservatorio_id');
            $table->decimal('volume', 15, 2);
            //$table->text('latitude')->nullable();
            //$table->text('longitude')->nullable();
            $table->decimal('temperatura')->nullable();
            $table->decimal('umidade')->nullable();
            $table->decimal('profundidade')->nullable();
            $table->timestamp('data')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historico_reservatorios');
    }
};
