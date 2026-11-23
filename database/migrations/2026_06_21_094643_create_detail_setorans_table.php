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
        Schema::create('detail_setoran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('setoran_id')->constrained('setoran')->onDelete('cascade');
            $table->foreignId('kategori_id')->constrained('kategori_sampah');
            $table->decimal('berat_kg', 8, 2);
            $table->integer('poin_didapat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_setorans');
    }
};
