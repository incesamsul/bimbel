<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketSoalRelasi extends Model
{
    use HasFactory;

    protected $table = 'paket_soal_relasi';
    protected $guarded = [''];

    public function soals()
    {
        return $this->hasMany(Soal::class, 'id', 'id_soal');
    }
    public function soal()
    {
        return $this->belongsTo(Soal::class, 'id_soal', 'id');
    }
}
