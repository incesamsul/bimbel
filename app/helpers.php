<?php

use App\Models\JawabanTryout;
use App\Models\KategoriSoal;
use App\Models\SegmentTryout;
use App\Models\Soal;


function lulusCheck($tiu, $tkp, $twk)
{
    $passing_grade_tiu = KategoriSoal::where('id', 1)->first()->passing_grade;
    $passing_grade_tkp = KategoriSoal::where('id', 2)->first()->passing_grade;
    $passing_grade_twk = KategoriSoal::where('id', 3)->first()->passing_grade;

    if ($tiu >= $passing_grade_tiu && $tkp >= $passing_grade_tkp && $twk >= $passing_grade_twk) {
        return 'LULUS';
    } else {
        return 'TIDAK LULUS';
    }
}
function getScoreTryout($segment_tryout_id, $user_id, $type)
{


    $finishedSegment = SegmentTryout::with('tryout.kelas')
        ->with('tryout.tryout_soal.soal')
        ->with('tryout.segment_tryout')
        ->where('user_id', $user_id)
        ->where('status', '1')
        ->where('id', $segment_tryout_id)
        ->latest('created_at')
        ->first();
    $tryoutSoal = $finishedSegment ? $finishedSegment->tryout->tryout_soal : [];
    $jumlahSoal = count($tryoutSoal);
    // 1 = tiu
    // 2 = tkp
    // 3 = twk
    $totalTiu = 0;
    $totalTkp = 0;
    $totalTwk = 0;
    foreach ($tryoutSoal as $row) {
        if ($row->soal->kategori_soal_id == 1) {
            $totalTiu++;
        } else if ($row->soal->kategori_soal_id == 2) {
            $totalTkp++;
        } else if ($row->soal->kategori_soal_id == 3) {
            $totalTwk++;
        }
    }


    $tiuTerjawab = 0;
    $tkpTerjawab = 0;
    $twkTerjawab = 0;

    $tiuTerjawabBenar = 0;
    $twkTerjawabBenar = 0;

    $tiuTerjawabSalah = 0;
    $twkTerjawabSalah = 0;

    $poinTkp5 = 0;
    $poinTkp4 = 0;
    $poinTkp3 = 0;
    $poinTkp2 = 0;
    $poinTkp1 = 0;

    $jawabanTryout = JawabanTryout::with('segment_tryout.tryout.tryout_soal.soal')
        ->where('user_id', $user_id)
        ->where('segment_tryout_id', $segment_tryout_id)
        ->get();

    $tiuTerjawabData = JawabanTryout::whereHas('soal', function ($query) {
        $query->where('kategori_soal_id', 1);
    })->where('segment_tryout_id', $segment_tryout_id)->get();

    $twkTerjawabData = JawabanTryout::whereHas('soal', function ($query) {
        $query->where('kategori_soal_id', 3);
    })->where('segment_tryout_id', $segment_tryout_id)->get();
    $tkpTerjawabData = JawabanTryout::whereHas('soal', function ($query) {
        $query->where('kategori_soal_id', 2);
    })->where('segment_tryout_id', $segment_tryout_id)->get();

    $tiuTerjawab = count($tiuTerjawabData);
    $twkTerjawab = count($twkTerjawabData);
    $tkpTerjawab = count($tkpTerjawabData);


    foreach ($tiuTerjawabData as $key => $value) {
        $kunciJawaban = Soal::where('id', $value->soal_id)->first()->jawaban;
        $jawaban = $value->jawaban;
        if ($jawaban == $kunciJawaban) {
            $tiuTerjawabBenar++;
        } else {
            $tiuTerjawabSalah++;
        }
    }

    foreach ($twkTerjawabData as $key => $value) {
        $kunciJawaban = Soal::where('id', $value->soal_id)->first()->jawaban;
        $jawaban = $value->jawaban;
        if ($jawaban == $kunciJawaban) {
            $twkTerjawabBenar++;
        } else {
            $twkTerjawabSalah++;
        }
    }

    foreach ($tkpTerjawabData as $key => $value) {
        $jawaban = $value->jawaban;

        $kunciJawaban = Soal::where('id', $value->soal_id)->first()->jawaban;
        $exploded_values = explode(',', $kunciJawaban);

        $search = [];
        $replace = [0, 1, 2, 3, 4];

        foreach ($exploded_values as $value) {
            $search[] = substr($value, 0, 1);
        }

        $output = str_replace($search, $replace, $kunciJawaban);

        $answers = explode(',', $output);


        foreach ($answers as $key => $value) {
            $answer = $value[0];
            if ($answer == $jawaban) {
                $poin = $value[1];
                if ($poin == 3) {
                    $poinTkp3++;
                }
                if ($poin == 5) {
                    $poinTkp5++;
                }
                if ($poin == 4) {
                    $poinTkp4++;
                }
                if ($poin == 2) {
                    $poinTkp2++;
                }
                if (
                    $poin == 1
                ) {
                    $poinTkp1++;
                }
            }
        }
    }



    $hasilTryout = [
        'total_soal_tiu' => $totalTiu,
        'total_soal_twk' => $totalTwk,
        'total_soal_tkp' => $totalTkp,

        'tiu_terjawab' => $tiuTerjawab,
        'twk_terjawab' => $twkTerjawab,
        'tkp_terjawab' => $tkpTerjawab,

        'tiu_tidak_terjawab' => $totalTiu - $tiuTerjawab,
        'twk_tidak_terjawab' => $totalTwk - $twkTerjawab,
        'tkp_tidak_terjawab' => $totalTkp - $tkpTerjawab,

        'twk_terjawab_benar' => $twkTerjawabBenar,
        'tiu_terjawab_benar' => $tiuTerjawabBenar,

        'twk_terjawab_salah' => $twkTerjawabSalah,
        'tiu_terjawab_salah' => $tiuTerjawabSalah,

        'total_poin_tiu' => $tiuTerjawabBenar * 5,
        'total_poin_twk' => $twkTerjawabBenar * 5,

        'poin_tkp_5' => $poinTkp5,
        'poin_tkp_4' => $poinTkp4,
        'poin_tkp_3' => $poinTkp3,
        'poin_tkp_2' => $poinTkp2,
        'poin_tkp_1' => $poinTkp1,

        'total_poin_tkp' => (($poinTkp5 * 5) + ($poinTkp4 * 4) + ($poinTkp3 * 3) + ($poinTkp2 * 2) + ($poinTkp1 * 1)),

        'passing_grade_tiu' => KategoriSoal::where('id', 1)->first()->passing_grade,
        'passing_grade_tkp' => KategoriSoal::where('id', 2)->first()->passing_grade,
        'passing_grade_twk' => KategoriSoal::where('id', 3)->first()->passing_grade,
    ];


    if ($type == 'tiu') {
        return $hasilTryout['total_poin_tiu'];
    } else if ($type == 'tkp') {
        return $hasilTryout['total_poin_tkp'];
    } else if ($type == 'twk') {
        return $hasilTryout['total_poin_twk'];
    } else if ($type == 'total') {
        return $hasilTryout['total_poin_tiu'] + $hasilTryout['total_poin_tkp'] + $hasilTryout['total_poin_twk'];
    } else if ($type == 'keterangan') {
        if ($hasilTryout['total_poin_tiu'] > $hasilTryout['passing_grade_tiu'] && $hasilTryout['total_poin_tkp'] > $hasilTryout['passing_grade_tkp'] && $hasilTryout['total_poin_twk'] > $hasilTryout['passing_grade_twk']) {
            return '<span class="badge badge-success">LULUS</span>';
        } else {
            return '<span class="badge badge-danger">TIDAK LULUS</span>';
        }
    }
}
