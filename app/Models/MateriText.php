<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriText extends Model
{
    use HasFactory;
    protected $table = 'materi_text';
    protected $guarded = [''];

    public function kategori()
    {
        return $this->belongsTo(KategoriSoal::class, 'kategori_soal_id', 'id');
    }
}
