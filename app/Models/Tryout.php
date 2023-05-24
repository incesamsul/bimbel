<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tryout extends Model
{
    use HasFactory;
    protected $table = 'tryout';
    protected $guarded = [''];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function tryout_soal()
    {
        return $this->hasMany(TryoutSoal::class, 'tryout_id', 'id');
    }

    public function segment_tryout()
    {
        return $this->hasOne(SegmentTryout::class, 'tryout_id', 'id');
    }
}
