<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketVideoRelasi extends Model
{
    use HasFactory;

    protected $table = 'paket_video_relasi';
    protected $guarded = [''];

    public function video()
    {
        return $this->belongsTo(MateriVideo::class, 'id_materi_video', 'id');
    }

    public function paket()
    {
        return $this->belongsTo(PaketVideo::class, 'id_paket_video', 'id');
    }
}
