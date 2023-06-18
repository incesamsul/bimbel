<?php

namespace App\Imports;

use App\Models\Pilihan;
use App\Models\Soal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SoalImport implements ToModel, WithHeadingRow

{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $soalId = Soal::create([
            'pertanyaan' => $row['pertanyaan'],
            'pembahasan' => $row['pembahasan'],
            'jawaban' => $row['jawaban'],
            'kelas_id' => $row['kelas_id'],
            'kategori_soal_id' => $row['kategori_soal_id'],
            'sub_kategori_soal_id' => $row['sub_kategori_soal_id'],
        ])->id;

        $dataPilihan = ['a', 'b', 'c', 'd', 'e'];

        foreach ($dataPilihan as $option) {
            Pilihan::create([
                'soal_id' => $soalId,
                'pilihan' => $row[$option],
                'is_correct' => $row[$option] == $row['jawaban'],
            ]);
        }

        return;
    }
}
