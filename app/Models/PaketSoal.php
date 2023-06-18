<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketSoal extends Model
{
    use HasFactory;

    protected $table = 'paket_soal';
    protected $guarded = [''];

    public function relasi_soal()
    {
        return $this->hasMany(PaketSoalRelasi::class, 'id_paket_soal', 'id');
    }
}
