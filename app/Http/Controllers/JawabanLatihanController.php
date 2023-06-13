<?php

namespace App\Http\Controllers;

use App\Models\JawabanLatihan;
use App\Models\JawabanTryout;
use Illuminate\Http\Request;

class JawabanLatihanController extends Controller
{
    public function saveAnswer(Request $request, $segmentLatihanId)
    {


        $cekJawaban = JawabanLatihan::where('soal_id', $request->questionId)
            ->where('segment_latihan_id', $segmentLatihanId)
            ->where('user_id', $request->user_id);
        if ($cekJawaban->first()) {
            $cekJawaban->update([
                'jawaban' => $request->answer,
                'ragu' => '0',
            ]);
        } else {
            JawabanLatihan::create([
                'soal_id' => $request->questionId,
                'jawaban' => $request->answer,
                'segment_latihan_id' => $segmentLatihanId,
                'user_id' => $request->user_id,
            ]);
        }

        return response()->json(['message' => 'Answer saved successfully'], 200);
    }

    public function deleteAnswer(Request $request, $segmentLatihanId)
    {

        $cekJawaban = JawabanLatihan::where('soal_id', $request->questionId)
            ->where('segment_latihan_id', $segmentLatihanId)
            ->where('user_id', $request->user_id)->delete();

        return response()->json(['message' => 'Answer deleted successfully'], 200);
    }

    public function flagAnswer(Request $request, $segmentLatihanId)
    {

        $cekJawaban = JawabanLatihan::where('soal_id', $request->questionId)
            ->where('segment_latihan_id', $segmentLatihanId)
            ->where('user_id', $request->user_id)->update([
                'ragu' => '1'
            ]);

        return response()->json(['message' => 'Answer flagged successfully'], 200);
    }

    public function deleteFlagAnswer(Request $request, $segmentLatihanId)
    {

        $cekJawaban = JawabanLatihan::where('soal_id', $request->questionId)
            ->where('segment_latihan_id', $segmentLatihanId)
            ->where('user_id', $request->user_id)->update([
                'ragu' => '0'
            ]);

        return response()->json(['message' => 'Answer flagged successfully'], 200);
    }
}
