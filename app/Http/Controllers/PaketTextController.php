<?php

namespace App\Http\Controllers;

use App\Models\PaketText;
use App\Models\PaketVideo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaketTextController extends Controller
{
    public function index()
    {
        return Inertia::render('PaketText/Index', [
            'user' => auth()->user(),
            'paket_text' => PaketText::all(),
        ]);
    }

    public function texts($idPaket)
    {
        return Inertia::render('PaketText/Texts', [
            'user' => auth()->user(),
            'paket_text' => PaketText::where('id', $idPaket)->first(),
            'id_paket_text' => $idPaket,
        ]);
    }

    public function create()
    {
        return Inertia::render('PaketText/Create', [
            'user' => auth()->user(),
        ]);
    }

    public function edit($idPaketVideo)
    {
        return Inertia::render('PaketText/Create', [
            'user' => auth()->user(),
            'edit' => PaketText::where('id', $idPaketVideo)->first()
        ]);
    }

    public function store(Request $request)
    {

        PaketText::create([
            'nama_paket' => $request->nama_paket,
        ])->id;

        return response()->json([
            'message' => 'kelas berhasil dibuat',
        ]);
    }

    public function update(Request $request)
    {

        PaketText::where('id', $request->id)->update([
            'nama_paket' => $request->nama_paket,
        ]);

        return response()->json([
            'message' => 'kelas berhasil dibuah',
        ]);
    }

    public function delete($idPaketVideo)
    {
        PaketText::where('id', $idPaketVideo)->delete();
        return response()->json([
            'message' => 'kelas berhasil dihapus',
        ]);
    }

    public function getPaketTextName($idPaketText)
    {
        $paket = PaketText::select('nama_paket')->where('id', $idPaketText)->first();
        return response()->json($paket);
    }
}
