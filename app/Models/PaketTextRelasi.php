<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketTextRelasi extends Model
{
    use HasFactory;

    protected $table = 'paket_text_relasi';
    protected $guarded = [''];

    public function text()
    {
        return $this->belongsTo(MateriText::class, 'id_materi_text', 'id');
    }

    public function paket()
    {
        return $this->belongsTo(PaketText::class, 'id_paket_text', 'id');
    }
}
