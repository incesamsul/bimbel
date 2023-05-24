<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKategoriSoal extends Model
{
    use HasFactory;

    protected $table = 'sub_kategori_soal';
    protected $guarded = [''];

    public function kategoriSoal()
    {
        return $this->belongsTo(KategoriSoal::class, 'kategori_soal_id', 'id');
    }
}
