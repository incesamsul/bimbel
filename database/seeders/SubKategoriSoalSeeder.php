<?php

namespace Database\Seeders;

use App\Models\SubKategoriSoal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubKategoriSoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1 = tiu
        // 2 = tkp
        // 3 = twb
        // 4 = skbb
        $kategori = [
            [
                'kategori_soal_id' => '1',
                'nama' => 'analogi dan silogisme',
            ],
            [
                'kategori_soal_id' => '1',
                'nama' => 'aritmatika sosial',
            ],
            [
                'kategori_soal_id' => '2',
                'nama' => 'jejaring kerja',
            ],
            [
                'kategori_soal_id' => '2',
                'nama' => 'pelayanan public',
            ],
            [
                'kategori_soal_id' => '2',
                'nama' => 'radikalisme',
            ],
            [
                'kategori_soal_id' => '2',
                'nama' => 'teknologi informasi',
            ],
            [
                'kategori_soal_id' => '3',
                'nama' => 'bahasa indonesia',
            ],
            [
                'kategori_soal_id' => '3',
                'nama' => 'integritas',
            ],
            [
                'kategori_soal_id' => '3',
                'nama' => 'lembaga negara',
            ],
            [
                'kategori_soal_id' => '3',
                'nama' => 'nkri',
            ],
            [
                'kategori_soal_id' => '4',
                'nama' => 'hamil',
            ],
            [
                'kategori_soal_id' => '4',
                'nama' => 'nifas',
            ],
        ];

        foreach ($kategori as $row) {
            SubKategoriSoal::create([
                'kategori_soal_id' => $row['kategori_soal_id'],
                'nama' => $row['nama'],
            ]);
        }
    }
}
