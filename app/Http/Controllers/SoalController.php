<?php

namespace App\Http\Controllers;

use App\Models\KategoriSoal;
use App\Models\Kelas;
use App\Models\Pilihan;
use App\Models\Soal;
use App\Models\SubKategoriSoal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SoalController extends Controller
{
    public function index()
    {
        return Inertia::render('Soal/Index', [
            'user' => auth()->user(),
            'soal' => Soal::with('kelas')->with('kategori_soal')->with('sub_kategori_soal')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Soal/Create', [
            'user' => auth()->user(),
            'kelas' => Kelas::all(),
            'kategori_soal' => KategoriSoal::all(),
        ]);
    }

    public function edit($idSoal)
    {
        return Inertia::render('Soal/Create', [
            'user' => auth()->user(),
            'edit' => Soal::with('pilihan')->where('id', $idSoal)->first()
        ]);
    }

    public function store(Request $request)
    {

        $soalId = Soal::create([
            'pertanyaan' => $request->pertanyaan,
            'pembahasan' => $request->pembahasan,
            'jawaban' => $request->jawaban,
            'kelas_id' => $request->kelas_id,
            'kategori_soal_id' => $request->kategori_soal_id,
            'sub_kategori_soal_id' => $request->sub_kategori_soal_id,
        ])->id;

        $dataPilihan = ['a', 'b', 'c', 'd', 'e'];

        foreach ($dataPilihan as $row) {
            Pilihan::create([
                'soal_id' => $soalId,
                'pilihan' => $request->$row,
                'is_correct' => $row == $request->jawaban,
            ]);
        }


        return response()->json([
            'message' => 'soal berhasil dibuat',
        ]);
    }

    public function update(Request $request)
    {

        $soalId = Soal::where('id', $request->id)->update([
            'pertanyaan' => $request->pertanyaan,
            'pembahasan' => $request->pembahasan,
            'kelas_id' => $request->kelas_id,
            'kategori_soal_id' => $request->kategori_soal_id,
            'sub_kategori_soal_id' => $request->sub_kategori_soal_id,
        ]);

        $dataPilihan = ['a', 'b', 'c', 'd', 'e'];

        Pilihan::where('soal_id', $request->id)->delete();

        foreach ($dataPilihan as $row) {
            Pilihan::create([
                'soal_id' => $request->id,
                'pilihan' => $request->$row,
                'is_correct' => $row == $request->jawaban,
            ]);
        }


        return response()->json([
            'message' => 'soal berhasil diupdate',
        ]);
    }

    public function delete($idSoal)
    {
        Soal::where('id', $idSoal)->delete();
        return response()->json([
            'message' => 'soal berhasil dihapus',
        ]);
    }
}
