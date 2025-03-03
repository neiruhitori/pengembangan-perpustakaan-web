<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('peminjamantahunan_id');
            // $table->string('buku');
            $table->foreignId('bukucruds_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('jml_buku');
            $table->string('kodebuku')->nullable();
            $table->timestamps();

            $table->foreign('peminjamantahunan_id')->references('id')->on('peminjamantahunan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bukus');
    }
}
