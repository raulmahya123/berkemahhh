<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;

class PaketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pakets')->insert([
            [
                'name' => 'Paket Basic',
                'desc' => 'Paket Basic dengan fitur dasar untuk pemula.',
                'slug' => Str::slug('Paket Basic'),
                'price' => 100000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Paket Standard',
                'desc' => 'Paket Standard dengan fitur menengah untuk pengguna umum.',
                'slug' => Str::slug('Paket Standard'),
                'price' => 200000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Paket Premium',
                'desc' => 'Paket Premium dengan fitur lengkap untuk profesional.',
                'slug' => Str::slug('Paket Premium'),
                'price' => 300000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
