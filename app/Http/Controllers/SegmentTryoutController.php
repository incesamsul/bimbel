<?php

namespace App\Http\Controllers;

use App\Models\SegmentTryout;
use Illuminate\Http\Request;

class SegmentTryoutController extends Controller
{
    public function makeSegment(Request $request, $tryoutId)
    {

        $cekJawaban = SegmentTryout::create([
            'user_id' => $request->user_id,
            'tryout_id' => $tryoutId,
            'mulai' => null,
            'selesai' => null,
            'durasi' => null,
            'status' => '0',

        ]);

        return response()->json(['message' => 'segment made successfully'], 200);
    }

    public function startSegment(Request $request, $tryoutId)
    {

        $cekJawaban = SegmentTryout::where('user_id', $request->user_id)
            ->where('tryout_id', $tryoutId)
            ->where('status', '0');

        $updatedSegment = $cekJawaban->update([
            'mulai' => date('Y-m-d H:i:s')
        ]);


        return response()->json(['segment_tryout_id' => $cekJawaban->first()->id], 200);
    }

    public function finishSegment(Request $request, $segmentTryoutId)
    {


        $cekJawaban = SegmentTryout::where('user_id', $request->user_id)
            ->where('id', $segmentTryoutId);


        $updatedSegment = $cekJawaban->update([
            'selesai' => date('Y-m-d H:i:s'),
            'durasi' => '100',
            'status' => '1'
        ]);


        return response()->json(['message' => 'done', 200]);
    }
}
