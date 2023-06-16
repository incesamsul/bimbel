<?php

namespace App\Http\Controllers;

use App\Models\KategoriSoal;
use App\Models\MateriText;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MateriTextController extends Controller
{
    public function index()
    {
        return Inertia::render('MateriText/Index', [
            'user' => auth()->user(),
            'materi_text' => MateriText::with('kategori')->get(),
        ]);
    }

    public function member()
    {
        return Inertia::render('MateriText/Member', [
            'user' => auth()->user(),
            'materi_text' => MateriText::with('kategori')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('MateriText/Create', [
            'user' => auth()->user(),
            'kategori_soal' => KategoriSoal::all(),
        ]);
    }

    public function edit($idKelas)
    {
        return Inertia::render('MateriText/Create', [
            'user' => auth()->user(),
            'edit' => MateriText::where('id', $idKelas)->first(),
            'kategori_soal' => KategoriSoal::all(),
        ]);
    }

    public function store(Request $request)
    {

        MateriText::create([
            'judul_materi' => $request->judul_materi,
            'link' => $request->link_materi,
            'kategori_soal_id' => $request->kategori,
        ])->id;

        return response()->json([
            'message' => 'kelas berhasil dibuat',
        ]);
    }

    public function update(Request $request)
    {

        MateriText::where('id', $request->id)->update([
            'judul_materi' => $request->judul_materi,
            'link' => $request->link_materi,
            'kategori_soal_id' => $request->kategori,
        ]);

        return response()->json([
            'message' => 'kelas berhasil dibuah',
        ]);
    }

    public function delete($idKelas)
    {
        MateriText::where('id', $idKelas)->delete();
        return response()->json([
            'message' => 'kelas berhasil dihapus',
        ]);
    }

    public function getTexts()
    {
        $text = MateriText::with('kategori')->get();
        return response()->json($text);
    }
}
