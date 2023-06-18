<?php

namespace App\Http\Controllers;

use App\Models\PaketSoalRelasi;

use Illuminate\Http\Request;

class PaketSoalRelasiController extends Controller
{
    public function addSoal(Request $request)
    {

        // Save the selectedIds to the database
        foreach ($request->id_soal as $id_soal) {
            PaketSoalRelasi::create([
                'id_soal' => $id_soal,
                'id_paket_soal' => $request->id_paket_soal,
            ]);
        }

        // Return a response to the client
        return response()->json(['message' => 'Data  berhasil di tambah']);
    }

    public function deleteSoal($idSoal)
    {

        // Retrieve the appropriate 'soal' data based on the 'id_tryout'
        $soal = PaketSoalRelasi::where('id_soal', $idSoal)->delete();

        // Return the 'soal' data as a JSON response
        return response()->json(['message' => 'Data soal berhasil dihapus']);
    }

    public function getSoalPaket($idPaket)
    {
        $soals = PaketSoalRelasi::with('soal.kategori_soal')->where('id_paket_soal', $idPaket)->get();
        return response()->json($soals);
    }
}
