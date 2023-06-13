<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatihanSoal extends Model
{
    use HasFactory;
    protected $table = 'latihan_soal';
    protected $guarded = [''];

    public function soal()
    {
        return $this->belongsTo(Soal::class, 'soal_id', '');
    }

    public function latihan()
    {
        return $this->belongsTo(Latihan::class, 'latihan_id', '');
    }

    public function jawaban_latihan()
    {
        return $this->belongsTo(JawabanLatihan::class, 'soal_id', 'soal_id');
    }
}
