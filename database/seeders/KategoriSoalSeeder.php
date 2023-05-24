<?php

namespace Database\Seeders;

use App\Models\KategoriSoal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $kategori = [
            [
                'kode' => 'TIU',
                'nama' => 'Tes Intelegensi Umum',
            ],
            [
                'kode' => 'TKP',
                'nama' => 'Tes Karakteristik Pribasi',
            ],
            [
                'kode' => 'TWB',
                'nama' => 'Tes Wawasan Kebangsaan',
            ],
            [
                'kode' => 'SKBB',
                'nama' => 'Skb Bidan',
            ]
        ];

        foreach ($kategori as $row) {
            KategoriSoal::create([
                'kode' => $row['kode'],
                'nama' => $row['nama'],
            ]);
        }
    }
}
