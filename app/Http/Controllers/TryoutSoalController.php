<?php

namespace App\Http\Controllers;

use App\Models\KategoriSoal;
use App\Models\Kelas;
use App\Models\Soal;
use App\Models\TryoutSoal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TryoutSoalController extends Controller
{
    public function index($idTryout = null)
    {
        return Inertia::render('TryoutSoal/Index', [
            'user' => auth()->user(),
            'tryout_soal' => TryoutSoal::with('soal.pilihan')->with('tryout')->where('tryout_id', $idTryout)->get(),
            'kategori_soals' => KategoriSoal::all(),
            'kelas' => Kelas::all(),
            'id_tryout' => $idTryout,
        ]);
    }


    public function searchSoal(Request $request)
    {
        $kategoriSoalId = $request->input('kategoriSoalId');
        $kelasId = $request->input('kelasId');
        $subKategoriSoalId = $request->input('subKategoriSoalId');

        // Build your query based on the provided search parameters
        $query = Soal::query();

        if ($kategoriSoalId) {
            $query->where('kategori_soal_id', $kategoriSoalId);
        }

        if ($kelasId) {
            $query->where('kelas_id', $kelasId);
        }

        if ($subKategoriSoalId) {
            $query->where('sub_kategori_soal_id', $subKategoriSoalId);
        }

        // Execute the query to get the search results
        $searchResults = $query->get();

        // Return the search results as a JSON response
        return response()->json($searchResults);
    }

    public function addSoal(Request $request)
    {

        // Save the selectedIds to the database
        foreach ($request->soal_id as $soal_id) {
            TryoutSoal::create([
                'soal_id' => $soal_id,
                'tryout_id' => $request->tryout_id,
            ]);
        }

        // Return a response to the client
        return response()->json(['message' => 'Data soal berhasil di tambah']);
    }

    public function getSoal($id_tryout, $segment_tryout_id)
    {

        // Retrieve the appropriate 'soal' data based on the 'id_tryout'
        $soal = TryoutSoal::with(['soal.pilihan', 'tryout', 'jawaban_tryout' => function ($query) use ($segment_tryout_id) {
            $query->where('segment_tryout_id', $segment_tryout_id);
        }])
            ->where('tryout_id', $id_tryout)
            ->get();


        // Return the 'soal' data as a JSON response
        return response()->json($soal);
    }

    public function deleteSoal($idTryoutSoal)
    {

        // Retrieve the appropriate 'soal' data based on the 'id_tryout'
        $soal = TryoutSoal::where('id', $idTryoutSoal)->delete();

        // Return the 'soal' data as a JSON response
        return response()->json(['message' => 'Data soal berhasil dihapus']);
    }
}
