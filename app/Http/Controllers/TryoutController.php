<?php

namespace App\Http\Controllers;

use App\Models\JawabanTryout;
use App\Models\KategoriSoal;
use App\Models\Kelas;
use App\Models\SegmentTryout;
use App\Models\Tryout;
use App\Models\TryoutSoal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TryoutController extends Controller
{
    public function index()
    {
        return Inertia::render('Tryout/Index', [
            'user' => auth()->user(),
            'tryout' => Tryout::with('kelas')->with('tryout_soal')->get(),
        ]);
    }

    public function member()
    {
        $activeSegment = SegmentTryout::with('tryout.kelas')
            ->with('tryout.tryout_soal')
            ->with('tryout.segment_tryout')
            ->where('user_id', auth()->user()->id)
            ->where('status', '0')
            ->first();

        if ($activeSegment) {
            // Perform the redirect to the desired route or URL
            return redirect('/member/tryout/konfirmasi');
        }

        return Inertia::render('Tryout/Member', [
            'user' => auth()->user(),
            'tryout' => Tryout::with('kelas')->with('tryout_soal')->get(),
        ]);
    }

    public function history($tryoutId)
    {

        return Inertia::render('Tryout/History', [
            'user' => auth()->user(),
            'history' => SegmentTryout::where('tryout_id', $tryoutId)->where('user_id', auth()->user()->id)->get()
        ]);
    }


    public function konfirmasi()
    {
        $activeSegment = SegmentTryout::with('tryout.kelas')
            ->with('tryout.tryout_soal')
            ->with('tryout.segment_tryout')
            ->where('user_id', auth()->user()->id)
            ->where('status', '0')
            ->latest('created_at')
            ->first();

        if (!$activeSegment) {
            // Perform the redirect to the desired route or URL
            return redirect('/member/tryout');
        }
        return Inertia::render('Tryout/Konfirmasi', [
            'user' => auth()->user(),
            // 'tryout' => Tryout::with('kelas')->with('tryout_soal')->with('segment_tryout')->where('id', $idTryout)->first(),
            'segment_tryout' => $activeSegment
        ]);
    }

    public function finish($segment_tryout_id)
    {
        $finishedSegment = SegmentTryout::with('tryout.kelas')
            ->with('tryout.tryout_soal.soal')
            ->with('tryout.segment_tryout')
            ->where('user_id', auth()->user()->id)
            ->where('status', '1')
            ->where('id', $segment_tryout_id)
            ->latest('created_at')
            ->first();
        $tryoutSoal = $finishedSegment->tryout->tryout_soal;
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
            ->where('user_id', auth()->user()->id)
            ->where('segment_tryout_id', $segment_tryout_id)
            ->get();

        $soalIds = []; // Array to store the IDs of questions that have been counted

        foreach ($jawabanTryout as $row) {
            $soalTerjawab = $row->segment_tryout->tryout->tryout_soal;

            foreach ($soalTerjawab as $index => $soal) {

                $soalId = $soal->soal->id;
                if (!in_array($soalId, $soalIds) && $soal->soal->kategori_soal_id == 1) {
                    $tiuTerjawab++;
                    $soalIds[] = $soalId; // Add the question ID to the array of counted IDs
                    if (isset($jawabanTryout[$index])) {
                        if ($soal->soal->jawaban == $jawabanTryout[$index]->jawaban) {
                            $tiuTerjawabBenar++;
                        } else {
                            $tiuTerjawabSalah++;
                        }
                    }
                }
                if (!in_array($soalId, $soalIds) && $soal->soal->kategori_soal_id == 2) {
                    $tkpTerjawab++;
                    $soalIds[] = $soalId; // Add the question ID to the array of counted IDs

                    if (isset($jawabanTryout[$index])) {

                        $exploded_values = explode(',', $soal->soal->jawaban);

                        $search = [];
                        $replace = [0, 1, 2, 3, 4];

                        foreach ($exploded_values as $value) {
                            $search[] = substr($value, 0, 1);
                        }

                        $output = str_replace($search, $replace, $soal->soal->jawaban);

                        $answers = explode(',', $output);


                        foreach ($answers as $key => $value) {
                            $answer = $value[0];
                            if ($answer == $jawabanTryout[$index]->jawaban) {
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
                    // sistem penilaian tkp BCADE : 54321
                    // 0:A = 3
                    // 1:B =
                    // 2:C = 4
                    // 3:D = 2
                    // 4:E = 1
                }
                if (!in_array($soalId, $soalIds) && $soal->soal->kategori_soal_id == 3) {
                    $twkTerjawab++;
                    $soalIds[] = $soalId; // Add the question ID to the array of counted IDs
                    if (isset($jawabanTryout[$index])) {
                        if ($soal->soal->jawaban == $jawabanTryout[$index]) {
                            $twkTerjawabBenar++;
                        } else {
                            $twkTerjawabSalah++;
                        }
                    }
                }
            }
        }



        // echo "total soal tiu  : " . $totalTiu . "<br>";
        // echo "total soal twk  : " . $totalTwk . "<br>";
        // echo "total soal tkp  : " . $totalTkp . "<br>";

        // echo "<br><br><br>";

        // echo "tiu terjawab : " . $tiuTerjawab . "<br>";
        // echo "twk terjawab : " . $twkTerjawab . "<br>";
        // echo "tkp terjawab : " . $tkpTerjawab . "<br>";

        // echo "<br><br><br>";

        // echo "tiu tidak terjawab : " . $totalTiu - $tiuTerjawab  . "<br>";
        // echo "twk tidak terjawab : " . $totalTwk - $twkTerjawab  . "<br>";
        // echo "tkp tidak terjawab : " . $totalTkp - $tkpTerjawab  . "<br>";

        // echo "<br><br><br>";

        // echo "tiu terjawab benar : " . $tiuTerjawabBenar . "<br>";
        // echo "twk terjawab benar : " . $twkTerjawabBenar . "<br>";

        // echo "<br><br><br>";

        // echo "tiu terjawab salah : " . $tiuTerjawabSalah . "<br>";
        // echo "twk terjawab salah : " . $twkTerjawabSalah . "<br>";

        // echo "<br><br><br>";

        // echo "poin tiu  : " . $tiuTerjawabBenar * 5 . "<br>";
        // echo "poin twk  : " . $twkTerjawabBenar * 5 . "<br>";


        // echo "<br><br><br>";

        // echo "poin tkp 5  : " . $poinTkp5 . "<br>";
        // echo "poin tkp 4  : " . $poinTkp4 . "<br>";
        // echo "poin tkp 3  : " . $poinTkp3 . "<br>";
        // echo "poin tkp 2  : " . $poinTkp2 . "<br>";
        // echo "poin tkp 1  : " . $poinTkp1 . "<br>";

        // echo "<br><br><br>";

        // echo "poin tkp   : " . (($poinTkp5 * 5) + ($poinTkp4 * 4) + ($poinTkp3 * 3) + ($poinTkp2 * 2) + ($poinTkp1 * 1)) . "<br>";

        // die;

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
        ];


        if (!$finishedSegment) {
            // Perform the redirect to the desired route or URL
            return redirect('/member/tryout');
        }
        return Inertia::render('Tryout/Finish', [
            'user' => auth()->user(),
            // 'tryout' => Tryout::with('kelas')->with('tryout_soal')->with('segment_tryout')->where('id', $idTryout)->first(),
            'segment_tryout' => $finishedSegment,
            'hasil_tryout' => json_encode($hasilTryout),
        ]);
    }

    public function kerjakan($segment_tryout_id)
    {
        $activeSegment = SegmentTryout::with('tryout.kelas')
            ->with('tryout.tryout_soal')
            ->with('tryout.segment_tryout')
            ->where('user_id', auth()->user()->id)
            ->where('status', '0')
            ->latest('created_at')
            ->first();

        if (!$activeSegment) {
            // Perform the redirect to the desired route or URL
            return redirect('/member/tryout');
        }
        return Inertia::render('Tryout/Kerjakan', [
            'user' => auth()->user(),
            // 'tryout_soal' => TryoutSoal::with('soal.pilihan')->with('tryout')->where('tryout_id', $segment_tryout_id)->get(),
            'kategori_soals' => KategoriSoal::all(),
            'kelas' => Kelas::all(),
            'segment_tryout_id' => $segment_tryout_id,
            'id_tryout' => SegmentTryout::where('id', $segment_tryout_id)->first()->tryout_id,
            'active_segment' => $activeSegment,
        ]);
    }

    public function review($segment_tryout_id)
    {


        return Inertia::render('Tryout/Review', [
            'user' => auth()->user(),
            // 'tryout_soal' => TryoutSoal::with('soal.pilihan')->with('tryout')->where('tryout_id', $segment_tryout_id)->get(),
            'kategori_soals' => KategoriSoal::all(),
            'kelas' => Kelas::all(),
            'segment_tryout_id' => $segment_tryout_id,
            'id_tryout' => SegmentTryout::where('id', $segment_tryout_id)->first()->tryout_id,
        ]);
    }


    public function create()
    {
        return Inertia::render('Tryout/Create', [
            'user' => auth()->user(),
            'kelas' => Kelas::all(),
        ]);
    }

    public function edit($idKelas)
    {
        return Inertia::render('Tryout/Create', [
            'user' => auth()->user(),
            'edit' => Tryout::where('id', $idKelas)->first(),
            'kelas' => Kelas::all(),
        ]);
    }

    public function store(Request $request)
    {

        Tryout::create([
            'nama_tryout' => $request->nama_tryout,
            'kelas_id' => $request->kelas_id,
            'durasi' => $request->durasi,
            'mulai' => $request->mulai,
        ])->id;

        return response()->json([
            'message' => 'Tryout berhasil dibuat',
        ]);
    }

    public function update(Request $request)
    {

        Tryout::where('id', $request->id)->update([
            'nama_tryout' => $request->nama_tryout,
            'kelas_id' => $request->kelas_id,
            'durasi' => $request->durasi,
            'mulai' => $request->mulai,
        ]);

        return response()->json([
            'message' => 'Tryout berhasil dibuah',
        ]);
    }

    public function delete($idKelas)
    {
        Tryout::where('id', $idKelas)->delete();
        return response()->json([
            'message' => 'Tryout berhasil dihapus',
        ]);
    }
}
