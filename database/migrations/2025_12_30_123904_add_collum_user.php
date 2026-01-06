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
        Schema::table('users', function (Blueprint $table) {
            
            $table->foreignId('idKantor')
                ->constrained('kantors')
                ->nullable()
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('idJabatan')
                ->constrained('jabatans')
                ->restrictOnDelete()
                ->nullable()
                ->cascadeOnUpdate();

            $table->foreignId('idRegu')
                ->constrained('regus')
                ->restrictOnDelete()
                ->nullable()
                ->cascadeOnUpdate();

            $table->string('noteleponPetugas', 30);
            $table->boolean('isActive')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
