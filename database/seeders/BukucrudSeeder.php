<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bukucrud;

class BukucrudSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bukucrud::updateOrCreate([
            'buku' => 'PAI',
            'penulis' => 'Pag 0',
            'penerbit' => 'Black Swan Books',
            'foto' => '',
            'description' => 'Buku ini berisikan tentang...',
            'stok' => '2'
        ]);
        Bukucrud::updateOrCreate([
            'buku' => 'PKn',
            'penulis' => 'Pag 1',
            'penerbit' => 'Black Swan Books',
            'foto' => '',
            'description' => 'Buku ini berisikan tentang...',
            'stok' => '2'
        ]);
        Bukucrud::updateOrCreate([
            'buku' => 'BIN',
            'penulis' => 'Pag 2',
            'penerbit' => 'Black Swan Books',
            'foto' => '',
            'description' => 'Buku ini berisikan tentang...',
            'stok' => '2'
        ]);
        Bukucrud::updateOrCreate([
            'buku' => 'BIG',
            'penulis' => 'Pag 3',
            'penerbit' => 'Black Swan Books',
            'foto' => '',
            'description' => 'Buku ini berisikan tentang...',
            'stok' => '2'
        ]);
        Bukucrud::updateOrCreate([
            'buku' => 'MAT',
            'penulis' => 'Pag 4',
            'penerbit' => 'Black Swan Books',
            'foto' => '',
            'description' => 'Buku ini berisikan tentang...',
            'stok' => '2'
        ]);
        Bukucrud::updateOrCreate([
            'buku' => 'IPA',
            'penulis' => 'Pag 5',
            'penerbit' => 'Black Swan Books',
            'foto' => '',
            'description' => 'Buku ini berisikan tentang...',
            'stok' => '2'
        ]);
        Bukucrud::updateOrCreate([
            'buku' => 'IPS',
            'penulis' => 'Pag 6',
            'penerbit' => 'Black Swan Books',
            'foto' => '',
            'description' => 'Buku ini berisikan tentang...',
            'stok' => '2'
        ]);
        Bukucrud::updateOrCreate([
            'buku' => 'TIK',
            'penulis' => 'Pag 7',
            'penerbit' => 'Black Swan Books',
            'foto' => '',
            'description' => 'Buku ini berisikan tentang...',
            'stok' => '2'
        ]);
        Bukucrud::updateOrCreate([
            'buku' => 'PJOK',
            'penulis' => 'Pag 8',
            'penerbit' => 'Black Swan Books',
            'foto' => '',
            'description' => 'Buku ini berisikan tentang...',
            'stok' => '2'
        ]);
        Bukucrud::updateOrCreate([
            'buku' => 'PRAKARYA (1)',
            'penulis' => 'Pag 9',
            'penerbit' => 'Black Swan Books',
            'foto' => '',
            'description' => 'Buku ini berisikan tentang...',
            'stok' => '2'
        ]);
        Bukucrud::updateOrCreate([
            'buku' => 'PRAKARYA (2)',
            'penulis' => 'Pag 10',
            'penerbit' => 'Black Swan Books',
            'foto' => '',
            'description' => 'Buku ini berisikan tentang...',
            'stok' => '2'
        ]);
        Bukucrud::updateOrCreate([
            'buku' => 'BAHASA JAWA',
            'penulis' => 'Pag 11',
            'penerbit' => 'Black Swan Books',
            'foto' => '',
            'description' => 'Buku ini berisikan tentang...',
            'stok' => '2'
        ]);
    }
}
