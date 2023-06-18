<?php

namespace App\Http\Controllers;

use App\Models\KategoriSoal;
use App\Models\Kelas;
use App\Models\LatihanSoal;
use App\Models\PaketSoal;
use App\Models\Soal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LatihanSoalController extends Controller
{
    public function index($idLatihan = null)
    {
        return Inertia::render('LatihanSoal/Index', [
            'user' => auth()->user(),
            'latihan_soal' => LatihanSoal::with('soal.pilihan')->with('latihan')->where('latihan_id', $idLatihan)->get(),
            'kategori_soals' => KategoriSoal::all(),
            'kelas' => Kelas::all(),
            'id_latihan' => $idLatihan,
            'paket_soal' => PaketSoal::all(),
        ]);
    }


    public function searchSoal(Request $request)
    {
        // $kategoriSoalId = $request->input('kategoriSoalId');
        // $kelasId = $request->input('kelasId');
        // $subKategoriSoalId = $request->input('subKategoriSoalId');

        // // Build your query based on the provided search parameters
        // $query = Soal::query();

        // if ($kategoriSoalId) {
        //     $query->where('kategori_soal_id', $kategoriSoalId);
        // }

        // if ($kelasId) {
        //     $query->where('kelas_id', $kelasId);
        // }

        // if ($subKategoriSoalId) {
        //     $query->where('sub_kategori_soal_id', $subKategoriSoalId);
        // }

        // // Execute the query to get the search results
        // $searchResults = $query->get();
        $paketSoal = $request->paket_soal;
        if ($paketSoal) {
            $paket = PaketSoal::where('id', $paketSoal)->first();
            $paket = PaketSoal::where('id', $paketSoal)->with('relasi_soal.soal')->first();

            // Access the related data
            $relasiSoal = $paket->relasi_soal;

            // Access the nested related data
            foreach ($relasiSoal as $soal) {
                $soalData = $soal->soal;
                // Access the attributes of the Soal model
                $soalId = $soalData->id;
                $soalTitle = $soalData->title;
                // ...
            }
            $searchResults = $relasiSoal;
        }
        // Return the search results as a JSON response
        return response()->json($searchResults);
    }

    public function addSoal(Request $request)
    {

        // Save the selectedIds to the database
        foreach ($request->soal_id as $soal_id) {
            LatihanSoal::create([
                'soal_id' => $soal_id,
                'latihan_id' => $request->latihan_id,
            ]);
        }

        // Return a response to the client
        return response()->json(['message' => 'Data soal berhasil di tambah']);
    }

    public function getSoal($id_latihan, $segment_latihan_id)
    {

        // Retrieve the appropriate 'soal' data based on the 'id_latihan'
        $soal = LatihanSoal::with(['soal.pilihan', 'latihan', 'jawaban_latihan' => function ($query) use ($segment_latihan_id) {
            $query->where('segment_latihan_id', $segment_latihan_id);
        }])
            ->where('latihan_id', $id_latihan)
            ->get();


        // Return the 'soal' data as a JSON response
        return response()->json($soal);
    }

    public function deleteSoal($idLatihanSoal)
    {

        // Retrieve the appropriate 'soal' data based on the 'id_latihan'
        $soal = LatihanSoal::where('id', $idLatihanSoal)->delete();

        // Return the 'soal' data as a JSON response
        return response()->json(['message' => 'Data soal berhasil dihapus']);
    }
}
