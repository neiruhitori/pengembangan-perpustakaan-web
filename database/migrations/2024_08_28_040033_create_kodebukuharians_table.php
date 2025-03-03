<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKodebukuHariansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kodebuku_harians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bukuharian_id')->constrained('bukusharians')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('kodebuku_harians');
    }
}
