<?php

namespace App\Http\Controllers;

use App\Models\KategoriSoal;
use App\Models\MateriVideo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MateriVideoController extends Controller
{
    public function index()
    {
        return Inertia::render('MateriVideo/Index', [
            'user' => auth()->user(),
            'materi_video' => MateriVideo::with('kategori')->get(),
        ]);
    }

    public function member()
    {
        return Inertia::render('MateriVideo/Member', [
            'user' => auth()->user(),
            'materi_video' => MateriVideo::with('kategori')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('MateriVideo/Create', [
            'user' => auth()->user(),
            'kategori_soal' => KategoriSoal::all(),
        ]);
    }

    public function edit($idKelas)
    {
        return Inertia::render('MateriVideo/Create', [
            'user' => auth()->user(),
            'edit' => MateriVideo::where('id', $idKelas)->first(),
            'kategori_soal' => KategoriSoal::all(),
        ]);
    }

    public function store(Request $request)
    {

        MateriVideo::create([
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

        MateriVideo::where('id', $request->id)->update([
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
        MateriVideo::where('id', $idKelas)->delete();
        return response()->json([
            'message' => 'kelas berhasil dihapus',
        ]);
    }

    public function getVideos()
    {
        $videos = MateriVideo::with('kategori')->get();
        return response()->json($videos);
    }
}
