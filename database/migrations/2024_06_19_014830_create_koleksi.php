<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('koleksi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_koleksi');
            $table->string('judul_buku');
            $table->string('pengarang');
            $table->string('kode_jenis');
            $table->string('penerbit');
            $table->year('tahun_terbit');
            $table->date('tgl_masuk')->nullable();
            $table->string('foto');
            $table->string('kode_sumber');
            $table->string('ketersediaan');
            $table->date('tgl_keluar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('koleksi');
    }
};
