<?php

namespace App\Http\Controllers;

use App\Models\JawabanLatihan;
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

    public function finishSegment(Request $request, $segmentLatihanId)
    {


        $updateStatus = SegmentLatihan::where('user_id', $request->user_id)
            ->where('id', $segmentLatihanId);

        if ($request->answer) {

            foreach ($request->answer as $row) {
                $existingRecord = JawabanLatihan::where([
                    'soal_id' => $row['soal_id'],
                    'segment_latihan_id' => $segmentLatihanId,
                    'user_id' => $request->user_id,
                ])->first();

                if ($existingRecord) {
                    // Handle the case where a duplicate record exists
                } else {
                    JawabanLatihan::create([
                        'soal_id' => $row['soal_id'],
                        'jawaban' => $row['answerOption'],
                        'segment_latihan_id' => $segmentLatihanId,
                        'user_id' => $request->user_id,
                    ]);
                }
            }
        }



        $updatedSegment = $updateStatus->update([
            'selesai' => date('Y-m-d H:i:s'),
            'durasi' => '100',
            'status' => '1'
        ]);


        return response()->json(['message' => 'done', 200]);

        // $cekJawaban = SegmentLatihan::where('user_id', $request->user_id)
        //     ->where('id', $segmentTryoutId);


        // $updatedSegment = $cekJawaban->update([
        //     'selesai' => date('Y-m-d H:i:s'),
        //     'durasi' => '100',
        //     'status' => '1'
        // ]);


        // return response()->json(['message' => 'done', 200]);
    }
}
