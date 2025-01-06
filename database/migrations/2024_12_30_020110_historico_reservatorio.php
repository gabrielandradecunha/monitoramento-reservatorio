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
            $table->unsignedBigInteger('reservatorio_id');
            $table->decimal('volume', 15, 2);
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
