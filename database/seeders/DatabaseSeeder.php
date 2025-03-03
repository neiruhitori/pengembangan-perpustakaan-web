<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::updateOrCreate([
            'perpustakaan_id' => '2141750010',
            'nip' => '19680810 200801 2 028',
            'name' => 'Umi Widarti, S.Pd.',
            'password' => bcrypt('admin'),

        ]);
    }
}
