<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // idKantor
            $table->foreignId('idKantor')
                ->nullable()
                ->constrained('kantors')
                ->restrictOnDelete() // atau ->nullOnDelete()
                ->cascadeOnUpdate();

            // idRegu
            $table->foreignId('idRegu')
                ->nullable()
                ->constrained('regus')
                ->restrictOnDelete() // atau ->nullOnDelete()
                ->cascadeOnUpdate();

            // Aman kalau sudah ada data user
            $table->string('noteleponPetugas', 30)->nullable();

            $table->boolean('isActive')->default(true);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // drop FK + kolom secara aman
            $table->dropConstrainedForeignId('idKantor');
            $table->dropConstrainedForeignId('idRegu');

            $table->dropColumn(['noteleponPetugas', 'isActive']);
        });
    }
};
