<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SegmentTryout extends Model
{
    use HasFactory;

    protected $table = 'segment_tryout';
    protected $guarded = [''];

    public function tryout()
    {
        return $this->belongsTo(Tryout::class, 'tryout_id', 'id');
    }
}
