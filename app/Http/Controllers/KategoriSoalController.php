<?php

namespace App\Http\Controllers;

use App\Models\KategoriSoal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KategoriSoalController extends Controller
{
    public function index()
    {
        return Inertia::render('KategoriSoal/Index', [
            'user' => auth()->user(),
            'kategori_soal' => KategoriSoal::all(),
        ]);
    }

    public function create()
    {
        return Inertia::render('KategoriSoal/Create', [
            'user' => auth()->user(),
        ]);
    }

    public function edit($id)
    {
        return Inertia::render('KategoriSoal/Create', [
            'user' => auth()->user(),
            'edit' => KategoriSoal::where('id', $id)->first()
        ]);
    }

    public function store(Request $request)
    {

        KategoriSoal::create([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'passing_grade' => $request->passing_grade,
        ])->id;

        return response()->json([
            'message' => 'kategori berhasil dibuat',
        ]);
    }

    public function update(Request $request)
    {

        KategoriSoal::where('id', $request->id)->update([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'passing_grade' => $request->passing_grade,
        ]);

        return response()->json([
            'message' => 'kategori berhasil dibuah',
        ]);
    }

    public function delete($id)
    {
        KategoriSoal::where('id', $id)->delete();
        return response()->json([
            'message' => 'kategori berhasil dihapus',
        ]);
    }
}
