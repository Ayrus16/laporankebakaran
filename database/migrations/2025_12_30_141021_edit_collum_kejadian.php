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
        Schema::table('kejadians', function (Blueprint $table) {
            $table->foreignId('idKecamatan')
                ->nullable()
                ->change();

            $table->foreignId('idKelurahan')
                ->nullable()
                ->change();
        });
    }

   
    public function down(): void
    {
        Schema::table('kejadians', function (Blueprint $table) {
            $table->foreignId('idKecamatan')
                ->nullable(false)
                ->change();

            $table->foreignId('idKelurahan')
                ->nullable(false)
                ->change();
        });
    }
};
