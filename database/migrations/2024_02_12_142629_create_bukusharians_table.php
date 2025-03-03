<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukushariansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukusharians', function (Blueprint $table) {
            $table->id();
            $table->string('buku');
            $table->string('penulis');
            $table->string('penerbit');
            $table->string('foto')->nullable();
            $table->text('description')->nullable();
            $table->integer('stok')->default(0);
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
        Schema::dropIfExists('bukusharians');
    }
}
