<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\PaketSoal;
use App\Models\PaketVideo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaketSoalController extends Controller
{
    public function index()
    {
        return Inertia::render('PaketSoal/Index', [
            'user' => auth()->user(),
            'paket_soal' => PaketSoal::all(),
        ]);
    }

    public function soals($idPaket, $kategori = null)
    {
        if ($kategori) {
            if ($kategori == 1) {
                return Inertia::render('PaketSoal/Tiu', [
                    'user' => auth()->user(),
                    'paket_soal' => PaketSoal::where('id', $idPaket)->first(),
                    'id_paket_soal' => $idPaket,
                    'kategori' => $kategori,
                    'kelas' => Kelas::all(),
                ]);
            } else {
                return Inertia::render('PaketSoal/Kategori', [
                    'user' => auth()->user(),
                    'paket_soal' => PaketSoal::where('id', $idPaket)->first(),
                    'id_paket_soal' => $idPaket,
                    'kategori' => $kategori,
                    'kelas' => Kelas::all(),
                ]);
            }
        } else {
            return Inertia::render('PaketSoal/Soals', [
                'user' => auth()->user(),
                'paket_soal' => PaketSoal::where('id', $idPaket)->first(),
                'id_paket_soal' => $idPaket,
                'kategori' => $kategori,
                'kelas' => Kelas::all(),
            ]);
        }
    }

    public function create()
    {
        return Inertia::render('PaketSoal/Create', [
            'user' => auth()->user(),
        ]);
    }

    public function edit($idPaketVideo)
    {
        return Inertia::render('PaketSoal/Create', [
            'user' => auth()->user(),
            'edit' => PaketSoal::where('id', $idPaketVideo)->first()
        ]);
    }

    public function store(Request $request)
    {

        PaketSoal::create([
            'nama_paket' => $request->nama_paket,
        ])->id;

        return response()->json([
            'message' => 'paket berhasil dibuat',
        ]);
    }

    public function update(Request $request)
    {

        PaketSoal::where('id', $request->id)->update([
            'nama_paket' => $request->nama_paket,
        ]);

        return response()->json([
            'message' => 'paket berhasil dibuah',
        ]);
    }

    public function delete($idPaketVideo)
    {
        PaketSoal::where('id', $idPaketVideo)->delete();
        return response()->json([
            'message' => 'paket berhasil dihapus',
        ]);
    }

    public function getPaketSoalName($idPaket)
    {
        $paket = PaketSoal::select('nama_paket')->where('id', $idPaket)->first();
        return response()->json($paket);
    }
}
