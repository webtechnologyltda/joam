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
        Schema::create('grupo_equipe_trabalhos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('image_path')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('equipe_trabalho', function (Blueprint $table) {
            $table->unsignedBigInteger('grupo_equipe_trabalho_id')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupo_equipe_trabalhos');
    }
};
