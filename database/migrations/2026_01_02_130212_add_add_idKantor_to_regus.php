<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('regus', function (Blueprint $table) {
            $table->foreignId('idKantor')
                ->constrained('kantors')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::table('regus', function (Blueprint $table) {
            $table->dropConstrainedForeignId('idKantor');
        });
    }
};
