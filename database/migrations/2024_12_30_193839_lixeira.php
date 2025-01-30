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
        Schema::create('lixeira', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->decimal('volume_maximo', 15, 2);
            $table->decimal('volume_atual', 15, 2);
            $table->timestamp('ultima_atualizacao');
            $table->text('descricao')->nullable();
            $table->text('mac')->nullble();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lixeira');
    }
};
