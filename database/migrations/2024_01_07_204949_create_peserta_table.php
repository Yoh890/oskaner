<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta', function (Blueprint $table) {
            $table->id();
            $table->integer('siswa_id');
            $table->integer('kelas_id');
            $table->integer('ekstra_id');
            $table->integer('hadir')->nullable();
            $table->integer('sakit')->nullable();
            $table->integer('ijin')->nullable();
            $table->integer('alpa')->nullable();
            $table->string('predikat')->nullable();
            $table->string('deskripsi')->nullable();
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
        Schema::dropIfExists('peserta');
    }
}
