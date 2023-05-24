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
        $tiu = 0;
        $tkp = 0;
        $twk = 0;
        foreach ($tryoutSoal as $row) {
            if ($row->soal->kategori_soal_id == 1) {
                $tiu++;
            } else if ($row->soal->kategori_soal_id == 2) {
                $tkp++;
            } else if ($row->soal->kategori_soal_id == 3) {
                $twk++;
            }
        }


        $tiuTerjawab = 0;
        $tkpTerjawab = 0;
        $twkTerjawab = 0;

        $tiuTerjawabBenar = 0;
        $tkpTerjawabBenar = 0;
        $twkTerjawabBenar = 0;

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
                    if ($soal->soal->jawaban == $jawabanTryout[$index]->jawaban) {
                        $tiuTerjawabBenar++;
                    }
                } else if (!in_array($soalId, $soalIds) && $soal->soal->kategori_soal_id == 2) {
                    $tkpTerjawab++;
                    $soalIds[] = $soalId; // Add the question ID to the array of counted IDs
                    if ($soal->soal->jawaban == $jawabanTryout[$index]->jawaban) {
                        $tkpTerjawabBenar++;
                    }
                }
                if (!in_array($soalId, $soalIds) && $soal->soal->kategori_soal_id == 3) {
                    $twkTerjawab++;
                    $soalIds[] = $soalId; // Add the question ID to the array of counted IDs
                    if ($soal->soal->jawaban == $jawabanTryout[$index]->jawaban) {
                        $twkTerjawabBenar++;
                    }
                }
            }
        }

        echo "total soal tiu  : " . $tiu . "<br>";
        echo "total soal twk  : " . $twk . "<br>";
        echo "total soal tkp  : " . $tkp . "<br>";

        echo "<br><br><br>";

        echo "tiu terjawab : " . $tiuTerjawab . "<br>";
        echo "twk terjawab : " . $twkTerjawab . "<br>";
        echo "tkp terjawab : " . $tkpTerjawab . "<br>";

        echo "<br><br><br>";

        echo "tiu terjawab benar : " . $tiuTerjawabBenar . "<br>";
        echo "twk terjawab benar : " . $twkTerjawabBenar . "<br>";
        echo "tkp terjawab benar : " . $tkpTerjawabBenar . "<br>";

        die;
        if (!$finishedSegment) {
            // Perform the redirect to the desired route or URL
            return redirect('/member/tryout');
        }
        return Inertia::render('Tryout/Finish', [
            'user' => auth()->user(),
            // 'tryout' => Tryout::with('kelas')->with('tryout_soal')->with('segment_tryout')->where('id', $idTryout)->first(),
            'segment_tryout' => $finishedSegment
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
