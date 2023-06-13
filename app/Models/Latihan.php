<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Latihan extends Model
{
    use HasFactory;
    protected $table = 'latihan';
    protected $guarded = [''];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function kategori_soal()
    {
        return $this->belongsTo(KategoriSoal::class, 'kategori_soal_id', 'id');
    }

    public function latihan_soal()
    {
        return $this->hasMany(LatihanSoal::class, 'latihan_id', 'id');
    }

    public function segment_latihan()
    {
        return $this->hasOne(Segmentlatihan::class, 'latihan_id', 'id');
    }
}
