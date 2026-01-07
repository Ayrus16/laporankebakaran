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
        Schema::create('kejadians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idKelurahan')
                ->constrained('kelurahans')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('idKecamatan')
                ->constrained('kecamatans')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('idLaporan')
                ->nullable()
                ->constrained('laporans')
                ->nullOnDelete()
                ->cascadeOnUpdate();
                
            $table->foreignId('kantor_id')
                ->nullable()
                ->constrained('kantors')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->string('LokasiKejadian');
            $table->decimal('luasTerbakar', 12, 2)->nullable();

            $table->date('tanggalKejadian')->nullable();
            $table->dateTime('waktuPenanganan')->nullable();
            $table->dateTime('waktuSelesai')->nullable();

            $table->decimal('tafsiranKerugian', 18, 2)->nullable();
            $table->string('fotoKejadian')->nullable();

            $table->text('keteranganTambahan')->nullable();
            $table->text('penyebabKebakaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kejadians');
    }
};
