<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanTryout extends Model
{
    use HasFactory;

    protected $table = 'jawaban_tryout';
    protected $guarded = [''];

    public function segment_tryout()
    {
        return $this->belongsTo(SegmentTryout::class, 'segment_tryout_id', 'id');
    }
}
