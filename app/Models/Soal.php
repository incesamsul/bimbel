<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;
    protected $table = 'soal';
    protected $guarded = [''];

    public function pilihan()
    {
        return $this->hasMany(Pilihan::class, 'soal_id', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function kategori_soal()
    {
        return $this->belongsTo(KategoriSoal::class, 'kategori_soal_id', 'id');
    }

    public function sub_kategori_soal()
    {
        return $this->belongsTo(SubKategoriSoal::class, 'sub_kategori_soal_id', 'id');
    }
}
