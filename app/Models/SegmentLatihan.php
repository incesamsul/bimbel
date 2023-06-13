<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SegmentLatihan extends Model
{
    use HasFactory;

    protected $table = 'segment_latihan';
    protected $guarded = [''];

    public function latihan()
    {
        return $this->belongsTo(Latihan::class, 'latihan_id', 'id');
    }
}
