<?php

namespace App\Http\Controllers;

use App\Models\SegmentLatihan;
use App\Models\SegmentTryout;
use Illuminate\Http\Request;

class SegmentLatihanController extends Controller
{
    public function makeSegment(Request $request, $latihanId)
    {

        $cekJawaban = SegmentLatihan::create([
            'user_id' => $request->user_id,
            'latihan_id' => $latihanId,
            'mulai' => null,
            'selesai' => null,
            'durasi' => null,
            'status' => '0',

        ]);

        return response()->json(['message' => 'segment made successfully'], 200);
    }

    public function startSegment(Request $request, $latihanId)
    {

        $cekJawaban = SegmentLatihan::where('user_id', $request->user_id)
            ->where('latihan_id', $latihanId)
            ->where('status', '0');

        $updatedSegment = $cekJawaban->update([
            'mulai' => date('Y-m-d H:i:s')
        ]);


        return response()->json(['segment_latihan_id' => $cekJawaban->first()->id], 200);
    }

    public function finishSegment(Request $request, $segmentTryoutId)
    {


        $cekJawaban = SegmentLatihan::where('user_id', $request->user_id)
            ->where('id', $segmentTryoutId);


        $updatedSegment = $cekJawaban->update([
            'selesai' => date('Y-m-d H:i:s'),
            'durasi' => '100',
            'status' => '1'
        ]);


        return response()->json(['message' => 'done', 200]);
    }
}
