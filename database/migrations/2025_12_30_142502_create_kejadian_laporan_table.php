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
        Schema::create('kejadian_laporan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kejadian_id')
                ->constrained('kejadians')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('laporan_id')
                ->constrained('laporans')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->timestamps();

            // cegah dobel relasi kejadian-laporan
            $table->unique(['kejadian_id', 'laporan_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kejadian_laporan');
    }
};
