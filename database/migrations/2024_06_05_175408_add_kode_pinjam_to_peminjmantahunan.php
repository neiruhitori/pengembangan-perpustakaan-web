<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKodePinjamToPeminjmantahunan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('peminjamantahunan', function (Blueprint $table) {
        //     $table->string('kode_pinjam')->after('id');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('peminjamantahunan', function (Blueprint $table) {
        //     $table->dropColumn('kode_pinjam');
        // });
    }
}
