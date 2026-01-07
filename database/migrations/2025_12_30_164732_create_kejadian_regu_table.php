<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kejadian_regu', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kejadian_id')
                ->constrained('kejadians')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('regu_id')
                ->constrained('regus')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->timestamps();

            $table->unique(['kejadian_id', 'regu_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kejadian_regu');
    }
};
