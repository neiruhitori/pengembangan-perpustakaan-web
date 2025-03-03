<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKodebukuTahunansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kodebuku_tahunans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bukucrud_id')->constrained('bukucruds')->onUpdate('cascade')->onDelete('cascade');
            $table->string('kodebuku')->nullable();
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
        Schema::dropIfExists('kodebuku_tahunans');
    }
}
