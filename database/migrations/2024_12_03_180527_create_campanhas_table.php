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
        Schema::create('campanhas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('logo')->nullable();
            $table->string('nome');
            $table->string('descricao');
            $table->string('slug')->unique();
            $table->text('informacoes');
            $table->dateTime('data_inicio');
            $table->dateTime('data_fim');
            $table->boolean('ativa')->default(true);
            $table->boolean('votante_cadastrado')->default(false);
            $table->integer('votos_por_usuario')->default(1);
            $table->boolean('mostrar_resultados_apos_voto')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campanhas');
    }
};
