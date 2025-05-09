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
            $table->id();
            $table->string('nome');
            $table->decimal('volume_maximo', 15, 2);
            $table->decimal('volume_atual', 15, 2);
            $table->timestamp('ultima_atualizacao');
            $table->text('descricao')->nullable();
            $table->text('mac')->nullable();
            $table->decimal('temperatura')->nullable();
            $table->decimal('umidade')->nullable();
            $table->decimal('profundidade')->nullable();
            //$table->text('latitude')->nullable();
            //$table->text('longitude')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->timestamps();
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
