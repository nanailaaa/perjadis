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
        Schema::create('t_perjalanan', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('foto_surat');
            $table->string('no_surat');
            $table->string('tujuan');
            $table->date('tgl_berangkat');
            $table->date('tgl_pulang');
            $table->string('hari');
            $table->string('no_sppd')->nullable();
            $table->string('tim_penanggung_jawab')->nullable();
            $table->text('deskripsi_kegiatan')->nullable();
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_perjalanan');
    }
};
