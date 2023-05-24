<?php

namespace App\Http\Controllers;

use App\Models\KategoriSoal;
use App\Models\SubKategoriSoal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubKategoriSoalController extends Controller
{
    public function index()
    {
        // dd(SubKategoriSoal::with('kategoriSoal')->get());
        return Inertia::render('SubKategoriSoal/Index', [
            'user' => auth()->user(),
            'sub_kategori_soal' => SubKategoriSoal::with('kategoriSoal')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('SubKategoriSoal/Create', [
            'user' => auth()->user(),
            'kategori' => KategoriSoal::all(),
        ]);
    }

    public function edit($id)
    {
        return Inertia::render('SubKategoriSoal/Create', [
            'user' => auth()->user(),
            'edit' => SubKategoriSoal::where('id', $id)->first()
        ]);
    }

    public function store(Request $request)
    {


        SubKategoriSoal::create([
            'kategori_soal_id' => $request->kategori_soal_id,
            'nama' => $request->nama,
        ])->id;

        return response()->json([
            'message' => 'sub kategori berhasil dibuat',
        ]);
    }

    public function update(Request $request)
    {

        SubKategoriSoal::where('id', $request->id)->update([
            'kategori_soal_id' => $request->kategori_soal_id,
            'nama' => $request->nama,
        ]);

        return response()->json([
            'message' => 'sub kategori berhasil dibuah',
        ]);
    }

    public function delete($id)
    {
        SubKategoriSoal::where('id', $id)->delete();
        return response()->json([
            'message' => 'sub kategori berhasil dihapus',
        ]);
    }


    public function getByKategoriSoal($idKategoriSoal)
    {


        $subKategoriSoalOptions = SubKategoriSoal::where('kategori_soal_id', $idKategoriSoal)
            ->get(['id', 'nama']);

        return response()->json(['options' => $subKategoriSoalOptions]);
    }
}
