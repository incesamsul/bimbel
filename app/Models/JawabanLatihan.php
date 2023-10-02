<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanLatihan extends Model
{
    use HasFactory;

    protected $table = 'jawaban_latihan';
    protected $guarded = [''];

    public function segment_latihan()
    {
        return $this->belongsTo(SegmentLatihan::class, 'segment_latihan_id', 'id');
    }

    public function soal()
    {
        return $this->belongsTo(Soal::class, 'soal_id', 'id');
    }
}
