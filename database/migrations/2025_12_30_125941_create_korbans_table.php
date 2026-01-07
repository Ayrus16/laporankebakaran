<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('korbans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kejadian_id')
                ->nullable()
                ->after('id')
                ->constrained('kejadians')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->string('nik', 16);         
            $table->string('namaLengkap');              
            $table->enum('jenisKelamin', ['L', 'P']);

            $table->text('alamat')->nullable();          
            $table->enum('status', [                    
                'selamat',
                'luka',
                'meninggal',
            ])->nullable();
            

            $table->text('keterangan')->nullable();      

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('korbans');
    }
};
