<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KelasController extends Controller
{
    public function index()
    {
        return Inertia::render('Kelas/Index', [
            'user' => auth()->user(),
            'kelas' => Kelas::all(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Kelas/Create', [
            'user' => auth()->user(),
        ]);
    }

    public function edit($idKelas)
    {
        return Inertia::render('Kelas/Create', [
            'user' => auth()->user(),
            'edit' => Kelas::where('id', $idKelas)->first()
        ]);
    }

    public function store(Request $request)
    {

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
        ])->id;

        return response()->json([
            'message' => 'kelas berhasil dibuat',
        ]);
    }

    public function update(Request $request)
    {

        Kelas::where('id', $request->id)->update([
            'nama_kelas' => $request->nama_kelas,
        ]);

        return response()->json([
            'message' => 'kelas berhasil dibuah',
        ]);
    }

    public function delete($idKelas)
    {
        Kelas::where('id', $idKelas)->delete();
        return response()->json([
            'message' => 'kelas berhasil dihapus',
        ]);
    }

    public function fetchKelas()
    {
        $kelas = Kelas::all();
        return response()->json($kelas);
    }
}
