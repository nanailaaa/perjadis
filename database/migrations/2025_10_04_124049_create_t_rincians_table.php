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
        Schema::create('t_rincians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perjalanan_id')->constrained('t_perjalanan')->cascadeOnDelete();

           $table->string('biaya_ke_bandara');
           $table->string('biaya_berangkat');
           $table->string('biaya_pulang');
           $table->string('biaya_hotel');
           $table->string('biaya_uh');
           $table->string('total_biaya');
           $table->string('foto_rincian');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('no_kursi_berangkat')->nullable();
            $table->string('no_kursi_pulang')->nullable();

           $table->foreignId('jenis_transport_berangkat')->constrained('m_jenis_transport')->cascadeOnDelete();
            $table->foreignId('jenis_transport_pulang')->constrained('m_jenis_transport')->cascadeOnDelete();
            $table->foreignId('jenis_transport_bandara')->constrained('m_jenis_transport')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_rincians');
    }
};
