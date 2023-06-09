<?php

namespace App\Http\Controllers;

use App\Models\JawabanLatihan;
use App\Models\KategoriSoal;
use App\Models\Kelas;
use App\Models\SegmentLatihan;
use App\Models\Latihan;
use App\Models\LatihanSoal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LatihanController extends Controller
{
    public function index()
    {
        return Inertia::render('Latihan/Index', [
            'user' => auth()->user(),
            'latihan' => Latihan::with('kelas')->with('latihan_soal')->with('kategori_soal')->get(),
        ]);
    }

    public function member()
    {

        $activeSegment = SegmentLatihan::with('latihan.kelas')
            ->with('latihan.latihan_soal')
            ->with('latihan.segment_latihan')
            ->where('user_id', auth()->user()->id)
            ->where('status', '0')
            ->first();

        if ($activeSegment) {
            // Perform the redirect to the desired route or URL
            return redirect()->route('latihan.konfirmasi');
        }

        return Inertia::render('Latihan/Member', [
            'user' => auth()->user(),
            'latihan' => Latihan::with('kelas')->with('latihan_soal')->get(),

        ]);
    }

    public function history($latihanId)
    {

        return Inertia::render('Latihan/History', [
            'user' => auth()->user(),
            'history' => SegmentLatihan::where('latihan_id', $latihanId)->where('user_id', auth()->user()->id)->get()
        ]);
    }


    public function konfirmasi()
    {
        $activeSegment = SegmentLatihan::with('latihan.kelas')
            ->with('latihan.latihan_soal')
            ->with('latihan.segment_latihan')
            ->where('user_id', auth()->user()->id)
            ->where('status', '0')
            ->latest('created_at')
            ->first();

        if (!$activeSegment) {
            // Perform the redirect to the desired route or URL
            return redirect()->route('latihan.konfirmasi');
        }
        return Inertia::render('Latihan/Konfirmasi', [
            'user' => auth()->user(),
            // 'latihan' => Latihan::with('kelas')->with('latihan_soal')->with('segment_latihan')->where('id', $idlatihan)->first(),
            'segment_latihan' => $activeSegment
        ]);
    }

    public function finish($segment_latihan_id)
    {
        $finishedSegment = SegmentLatihan::with('latihan.kelas')
            ->with('latihan.latihan_soal.soal')
            ->with('latihan.segment_latihan')
            ->where('user_id', auth()->user()->id)
            ->where('status', '1')
            ->where('id', $segment_latihan_id)
            ->latest('created_at')
            ->first();
        $latihanSoal = $finishedSegment->latihan->latihan_soal;
        $jumlahSoal = count($latihanSoal);
        // 1 = tiu
        // 2 = tkp
        // 3 = twk
        $totalTiu = 0;
        $totalTkp = 0;
        $totalTwk = 0;
        foreach ($latihanSoal as $row) {
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

        $jawabanlatihan = JawabanLatihan::with('segment_latihan.latihan.latihan_soal.soal')
            ->where('user_id', auth()->user()->id)
            ->where('segment_latihan_id', $segment_latihan_id)
            ->get();

        $soalIds = []; // Array to store the IDs of questions that have been counted

        foreach ($jawabanlatihan as $row) {
            $soalTerjawab = $row->segment_latihan->latihan->latihan_soal;

            foreach ($soalTerjawab as $index => $soal) {

                $soalId = $soal->soal->id;
                if (!in_array($soalId, $soalIds) && $soal->soal->kategori_soal_id == 1) {
                    $tiuTerjawab++;
                    $soalIds[] = $soalId; // Add the question ID to the array of counted IDs
                    if (isset($jawabanlatihan[$index])) {
                        if ($soal->soal->jawaban == $jawabanlatihan[$index]->jawaban) {
                            $tiuTerjawabBenar++;
                        } else {
                            $tiuTerjawabSalah++;
                        }
                    }
                }
                if (!in_array($soalId, $soalIds) && $soal->soal->kategori_soal_id == 2) {
                    $tkpTerjawab++;
                    $soalIds[] = $soalId; // Add the question ID to the array of counted IDs

                    if (isset($jawabanlatihan[$index])) {
                        if ($jawabanlatihan[$index]->jawaban == 0) {
                            $poinTkp3++;
                        }
                        if ($jawabanlatihan[$index]->jawaban == 1) {
                            $poinTkp5++;
                        }
                        if ($jawabanlatihan[$index]->jawaban == 2) {
                            $poinTkp4++;
                        }
                        if ($jawabanlatihan[$index]->jawaban == 3) {
                            $poinTkp2++;
                        }
                        if ($jawabanlatihan[$index]->jawaban == 4) {
                            $poinTkp1++;
                        }
                    }
                    // sistem penilaian tkp BCADE : 54321
                    // 0:A = 3
                    // 1:B = 5
                    // 2:C = 4
                    // 3:D = 2
                    // 4:E = 1
                }
                if (!in_array($soalId, $soalIds) && $soal->soal->kategori_soal_id == 3) {
                    $twkTerjawab++;
                    $soalIds[] = $soalId; // Add the question ID to the array of counted IDs
                    if (isset($jawabanlatihan[$index])) {
                        if ($soal->soal->jawaban == $jawabanlatihan[$index]) {
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

        $hasillatihan = [
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
            return redirect()->route('latihan.konfirmasi');
        }
        return Inertia::render('Latihan/Finish', [
            'user' => auth()->user(),
            // 'latihan' => Latihan::with('kelas')->with('latihan_soal')->with('segment_latihan')->where('id', $idlatihan)->first(),
            'segment_latihan' => $finishedSegment,
            'hasil_latihan' => json_encode($hasillatihan),
        ]);
    }

    public function kerjakan($segment_latihan_id)
    {
        $activeSegment = SegmentLatihan::with('latihan.kelas')
            ->with('latihan.latihan_soal')
            ->with('latihan.segment_latihan')
            ->where('user_id', auth()->user()->id)
            ->where('status', '0')
            ->latest('created_at')
            ->first();

        if (!$activeSegment) {
            // Perform the redirect to the desired route or URL
            return redirect()->route('latihan.konfirmasi');
        }
        return Inertia::render('Latihan/Kerjakan', [
            'user' => auth()->user(),
            // 'latihan_soal' => latihanSoal::with('soal.pilihan')->with('latihan')->where('latihan_id', $segment_latihan_id)->get(),
            'kategori_soals' => KategoriSoal::all(),
            'kelas' => Kelas::all(),
            'segment_latihan_id' => $segment_latihan_id,
            'id_latihan' => SegmentLatihan::where('id', $segment_latihan_id)->first()->latihan_id,
            'active_segment' => $activeSegment,
        ]);
    }

    public function review($segment_latihan_id)
    {


        return Inertia::render('Latihan/Review', [
            'user' => auth()->user(),
            // 'latihan_soal' => latihanSoal::with('soal.pilihan')->with('latihan')->where('latihan_id', $segment_latihan_id)->get(),
            'kategori_soals' => KategoriSoal::all(),
            'kelas' => Kelas::all(),
            'segment_latihan_id' => $segment_latihan_id,
            'id_latihan' => SegmentLatihan::where('id', $segment_latihan_id)->first()->latihan_id,
        ]);
    }


    public function create()
    {
        return Inertia::render('Latihan/Create', [
            'user' => auth()->user(),
            'kelas' => Kelas::all(),
            'kategori_soal' => KategoriSoal::all(),
        ]);
    }

    public function edit($idKelas)
    {
        return Inertia::render('Latihan/Create', [
            'user' => auth()->user(),
            'edit' => Latihan::where('id', $idKelas)->first(),
            'kelas' => Kelas::all(),
        ]);
    }

    public function store(Request $request)
    {

        Latihan::create([
            'nama_latihan' => $request->nama_latihan,
            'kelas_id' => $request->kelas_id,
            'durasi' => $request->durasi,
            'mulai' => $request->mulai,
            'kategori_soal_id' => $request->kategori_soal_id,
        ])->id;

        return response()->json([
            'message' => 'latihan berhasil dibuat',
        ]);
    }

    public function update(Request $request)
    {

        Latihan::where('id', $request->id)->update([
            'nama_latihan' => $request->nama_latihan,
            'kelas_id' => $request->kelas_id,
            'durasi' => $request->durasi,
            'mulai' => $request->mulai,
        ]);

        return response()->json([
            'message' => 'latihan berhasil dibuah',
        ]);
    }

    public function delete($idKelas)
    {
        Latihan::where('id', $idKelas)->delete();
        return response()->json([
            'message' => 'latihan berhasil dihapus',
        ]);
    }
}
