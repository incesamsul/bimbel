<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            [
                'nama_kelas' => 'Persiapan cpns',
            ],
            [
                'nama_kelas' => 'Persiapan kemerdekaan',
            ],
        ];

        foreach ($kategori as $row) {
            Kelas::create([
                'nama_kelas' => $row['nama_kelas'],
            ]);
        }
    }
}
