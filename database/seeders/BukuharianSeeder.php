<?php

namespace Database\Seeders;

use App\Models\Bukusharian;
use Illuminate\Database\Seeder;

class BukuharianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bukusharian::updateOrCreate([
            'buku' => 'PAI'
        ]);
        Bukusharian::updateOrCreate([
            'buku' => 'PKn'
        ]);
        Bukusharian::updateOrCreate([
            'buku' => 'BIN'
        ]);
        Bukusharian::updateOrCreate([
            'buku' => 'BIG'
        ]);
        Bukusharian::updateOrCreate([
            'buku' => 'MAT'
        ]);
        Bukusharian::updateOrCreate([
            'buku' => 'IPA'
        ]);
        Bukusharian::updateOrCreate([
            'buku' => 'IPS'
        ]);
        Bukusharian::updateOrCreate([
            'buku' => 'TIK'
        ]);
        Bukusharian::updateOrCreate([
            'buku' => 'PJOK'
        ]);
        Bukusharian::updateOrCreate([
            'buku' => 'PRAKARYA (1)'
        ]);
        Bukusharian::updateOrCreate([
            'buku' => 'PRAKARYA (2)'
        ]);
        Bukusharian::updateOrCreate([
            'buku' => 'BAHASA JAWA'
        ]);
    }
}
