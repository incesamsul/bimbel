<?php

namespace App\Http\Controllers;

use App\Models\JawabanTryout;
use Illuminate\Http\Request;

class JawabanTryoutController extends Controller
{
    public function saveAnswer(Request $request, $segmentTryoutId)
    {


        $cekJawaban = JawabanTryout::where('soal_id', $request->questionId)
            ->where('segment_tryout_id', $segmentTryoutId)
            ->where('user_id', $request->user_id);
        if ($cekJawaban->first()) {
            $cekJawaban->update([
                'jawaban' => $request->answer,
                'ragu' => '0',
            ]);
        } else {
            JawabanTryout::create([
                'soal_id' => $request->questionId,
                'jawaban' => $request->answer,
                'segment_tryout_id' => $segmentTryoutId,
                'user_id' => $request->user_id,
            ]);
        }

        return response()->json(['message' => 'Answer saved successfully'], 200);
    }

    public function deleteAnswer(Request $request, $segmentTryoutId)
    {

        $cekJawaban = JawabanTryout::where('soal_id', $request->questionId)
            ->where('segment_tryout_id', $segmentTryoutId)
            ->where('user_id', $request->user_id)->delete();

        return response()->json(['message' => 'Answer deleted successfully'], 200);
    }

    public function flagAnswer(Request $request, $segmentTryoutId)
    {

        $cekJawaban = JawabanTryout::where('soal_id', $request->questionId)
            ->where('segment_tryout_id', $segmentTryoutId)
            ->where('user_id', $request->user_id)->update([
                'ragu' => '1'
            ]);

        return response()->json(['message' => 'Answer flagged successfully'], 200);
    }

    public function deleteFlagAnswer(Request $request, $segmentTryoutId)
    {

        $cekJawaban = JawabanTryout::where('soal_id', $request->questionId)
            ->where('segment_tryout_id', $segmentTryoutId)
            ->where('user_id', $request->user_id)->update([
                'ragu' => '0'
            ]);

        return response()->json(['message' => 'Answer flagged successfully'], 200);
    }
}
