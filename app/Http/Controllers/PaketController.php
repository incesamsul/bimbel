<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use App\Models\Latihan;
use App\Models\Paket;
use App\Models\PaketText;
use App\Models\PaketVideo;
use App\Models\SegmentLatihan;
use App\Models\SegmentTryout;
use App\Models\Transaksi;
use App\Models\Tryout;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaketController extends Controller
{
    public function index()
    {
        return Inertia::render('Paket/Index', [
            'user' => auth()->user(),
            'paket' => Paket::all(),
        ]);
    }

    public function member()
    {
        return Inertia::render('Paket/Member', [
            'user' => auth()->user(),
            'paket' => Paket::all(),
            'paket_saya' => Transaksi::with('paket')->where('id_user', auth()->user()->id)->where('status', 'paid')->get(),
            'diskon' => Diskon::all()->first() ? Diskon::all()->first()->persen : 0,
        ]);
    }

    public function aktif()
    {
        return Inertia::render('Paket/Aktif', [
            'user' => auth()->user(),
            'paket' => Transaksi::with('paket')->where('id_user', auth()->user()->id)->where('status', 'paid')->get(),
        ]);
    }

    public function content($idPaket)
    {
        $transaksi = Transaksi::with('paket')
            ->whereHas('paket', function ($query) use ($idPaket) {
                $query->where('id', $idPaket);
            })
            ->where('id_user', auth()->user()->id)
            ->where('status', 'paid')
            ->first();
        return Inertia::render('Paket/Content', [
            'user' => auth()->user(),
            'transaksi' => $transaksi
        ]);
    }

    public function contentVideo($idPaket)
    {

        $transaksi = Transaksi::with('paket')
            ->whereHas('paket', function ($query) use ($idPaket) {
                $query->where('id', $idPaket);
            })
            ->where('id_user', auth()->user()->id)
            ->where('status', 'paid')
            ->first();
        $paket = $transaksi->paket;
        $arrPaket = explode(",", $paket->paket_video);
        $paketData = [];

        foreach ($arrPaket as $paketId) {
            $paketName = PaketVideo::select('nama_paket')->where('id', $paketId)->first();
            $paketData[] = [
                'id' => $paketId,
                'nama_paket' => $paketName ? $paketName->nama_paket : '',
            ];
        }

        return Inertia::render('Paket/ContentVideo', [
            'user' => auth()->user(),
            'paket' => $paket,
            'paket_video' => json_encode($paketData),
        ]);
    }

    public function contentText($idPaket)
    {

        $transaksi = Transaksi::with('paket')
            ->whereHas('paket', function ($query) use ($idPaket) {
                $query->where('id', $idPaket);
            })
            ->where('id_user', auth()->user()->id)
            ->where('status', 'paid')
            ->first();
        $paket = $transaksi->paket;
        $arrPaket = explode(",", $paket->paket_video);
        $paketData = [];

        foreach ($arrPaket as $paketId) {
            $paketName = PaketText::select('nama_paket')->where('id', $paketId)->first();
            $paketData[] = [
                'id' => $paketId,
                'nama_paket' => $paketName ? $paketName->nama_paket : '',
            ];
        }

        return Inertia::render('Paket/ContentText', [
            'user' => auth()->user(),
            'paket' => $paket,
            'paket_text' => json_encode($paketData),
        ]);
    }


    public function contentTryout($idPaket)
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
        $transaksi = Transaksi::with('paket')
            ->whereHas('paket', function ($query) use ($idPaket) {
                $query->where('id', $idPaket);
            })
            ->where('id_user', auth()->user()->id)
            ->where('status', 'paid')
            ->first();
        $paket = $transaksi->paket;
        $arrPaket = explode(",", $paket->paket_tryout);
        $paketData = [];

        foreach ($arrPaket as $paketId) {
            $paketData[] = Tryout::with('tryout_soal')->where('id', $paketId)->first();
        }

        return Inertia::render('Paket/ContentTryout', [
            'user' => auth()->user(),
            'paket' => $paket,
            'tryout' => json_encode($paketData),
        ]);
    }

    public function contentLatihan($idPaket)
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
        $transaksi = Transaksi::with('paket')
            ->whereHas('paket', function ($query) use ($idPaket) {
                $query->where('id', $idPaket);
            })
            ->where('id_user', auth()->user()->id)
            ->where('status', 'paid')
            ->first();
        $paket = $transaksi->paket;
        $arrPaket = explode(",", $paket->paket_latihan);
        $paketData = [];

        foreach ($arrPaket as $paketId) {
            $paketData[] = Latihan::with('latihan_soal')->where('id', $paketId)->first();
        }

        return Inertia::render('Paket/ContentLatihan', [
            'user' => auth()->user(),
            'paket' => $paket,
            'latihan' => json_encode($paketData),
        ]);
    }


    public function videos($idPaket, $idPaketVideo)
    {
        return Inertia::render('Paket/Videos', [
            'user' => auth()->user(),
            'id_paket_video' => $idPaketVideo,
            'id_paket' => $idPaket,
        ]);
    }

    public function texts($idPaket, $idPaketText)
    {
        return Inertia::render('Paket/Texts', [
            'user' => auth()->user(),
            'id_paket_text' => $idPaketText,
            'id_paket' => $idPaket,
        ]);
    }


    public function create()
    {
        return Inertia::render('Paket/Create', [
            'user' => auth()->user(),
            'paket_video' => PaketVideo::all(),
            'paket_text' => PaketText::all(),
            'paket_tryout' => Tryout::all(),
            'paket_latihan' => Latihan::all(),
        ]);
    }

    public function edit($idKelas)
    {
        return Inertia::render('Paket/Create', [
            'user' => auth()->user(),
            'edit' => Paket::where('id', $idKelas)->first(),
            'paket_video' => PaketVideo::all(),
            'paket_text' => PaketText::all(),
            'paket_tryout' => Tryout::all(),
            'paket_latihan' => Latihan::all(),
        ]);
    }

    public function store(Request $request)
    {

        Paket::create([
            'nama_paket' => $request->nama_paket,
            'link_telegram' => $request->link_telegram,
            'paket_video' => $request->paket_video,
            'paket_text' => $request->paket_text,
            'paket_tryout' => $request->paket_tryout,
            'paket_latihan' => $request->paket_latihan,
            'harga' => $request->harga,
            'list_paket' => $request->list_paket,
            'jenis_paket' => $request->jenis_paket
        ])->id;

        return response()->json([
            'message' => 'kelas berhasil dibuat',
        ]);
    }

    public function update(Request $request)
    {

        Paket::where('id', $request->id)->update([
            'nama_paket' => $request->nama_paket,
            'link_telegram' => $request->link_telegram,
            'paket_video' => $request->paket_video,
            'paket_text' => $request->paket_text,
            'paket_tryout' => $request->paket_tryout,
            'paket_latihan' => $request->paket_latihan,
            'harga' => $request->harga,
            'list_paket' => $request->list_paket,
            'jenis_paket' => $request->jenis_paket
        ]);

        return response()->json([
            'message' => 'kelas berhasil dibuah',
        ]);
    }

    public function delete($idKelas)
    {
        Paket::where('id', $idKelas)->delete();
        return response()->json([
            'message' => 'kelas berhasil dihapus',
        ]);
    }

    public function getAll()
    {
        $paket = Paket::all();
        return response()->json(
            $paket
        );
    }
}
