<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('siswas_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

            // $table->string('buku');
            $table->foreignId('bukusharians_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->string('jml_buku'); 
            $table->dateTime('jam_pinjam');
            $table->datetime('jam_kembali');
            $table->text('description')->nullable();
            $table->integer('status')->default(1); // 0: disable, 1: enable
            $table->timestamps();

            // $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
}
