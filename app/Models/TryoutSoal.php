<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TryoutSoal extends Model
{
    use HasFactory;
    protected $table = 'tryout_soal';
    protected $guarded = [''];

    public function soal()
    {
        return $this->belongsTo(Soal::class, 'soal_id', '');
    }

    public function tryout()
    {
        return $this->belongsTo(Tryout::class, 'tryout_id', '');
    }

    public function jawaban_tryout()
    {
        return $this->belongsTo(JawabanTryout::class, 'soal_id', 'soal_id');
    }
}
