<?php

namespace App\Http\Controllers;

use App\Models\PaketVideo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaketVideoController extends Controller
{
    public function index()
    {
        return Inertia::render('PaketVideo/Index', [
            'user' => auth()->user(),
            'paket_video' => PaketVideo::all(),
        ]);
    }

    public function videos($idPaket)
    {
        return Inertia::render('PaketVideo/Videos', [
            'user' => auth()->user(),
            'paket_video' => PaketVideo::where('id', $idPaket)->first(),
            'id_paket_video' => $idPaket,
        ]);
    }

    public function create()
    {
        return Inertia::render('PaketVideo/Create', [
            'user' => auth()->user(),
        ]);
    }

    public function edit($idPaketVideo)
    {
        return Inertia::render('PaketVideo/Create', [
            'user' => auth()->user(),
            'edit' => PaketVideo::where('id', $idPaketVideo)->first()
        ]);
    }

    public function store(Request $request)
    {

        PaketVideo::create([
            'nama_paket' => $request->nama_paket,
        ])->id;

        return response()->json([
            'message' => 'kelas berhasil dibuat',
        ]);
    }

    public function update(Request $request)
    {

        PaketVideo::where('id', $request->id)->update([
            'nama_paket' => $request->nama_paket,
        ]);

        return response()->json([
            'message' => 'kelas berhasil dibuah',
        ]);
    }

    public function delete($idPaketVideo)
    {
        PaketVideo::where('id', $idPaketVideo)->delete();
        return response()->json([
            'message' => 'kelas berhasil dihapus',
        ]);
    }

    public function getPaketVideoName($idPaketVideo)
    {
        $paket = PaketVideo::select('nama_paket')->where('id', $idPaketVideo)->first();
        return response()->json($paket);
    }
}
