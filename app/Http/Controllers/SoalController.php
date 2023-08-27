<?php

namespace App\Http\Controllers;

use App\Imports\SoalImport;
use App\Models\KategoriSoal;
use App\Models\Kelas;
use App\Models\Pilihan;
use App\Models\Soal;
use App\Models\SubKategoriSoal;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class SoalController extends Controller
{
    public function index()
    {
        return Inertia::render('Soal/Index', [
            'user' => auth()->user(),
            // 'soal' => Soal::with('kelas')->with('kategori_soal')->with('sub_kategori_soal')->where('kategori_soal_id', '!=', 1)->get(),
            'soal' => Soal::with('kelas')->with('kategori_soal')->with('sub_kategori_soal')->get(),
        ]);
    }

    public function soalDatatable()
    {
        $query = Soal::with('kelas')->with('kategori_soal')->with('sub_kategori_soal');

        return DataTables::eloquent($query)
            ->addColumn('kelas', function ($soal) {
                return $soal->kelas->nama_kelas;
            })
            ->addColumn('kategori', function ($soal) {
                return $soal->kategori_soal->nama;
            })
            ->addColumn('sub_kategori', function ($soal) {
                return $soal->sub_kategori_soal->nama;
            })
            ->addColumn('pertanyaan', function ($soal) {
                return $soal->pertanyaan;
            })
            ->addColumn('actions', function ($soal) {
                return "<button class='shadow-none btn btn-sm bg-main text-white btn-hapus' data-id='$soal->id'><i class='fas fa-trash'></i> </button>
                        <button class='ml-1 shadow-none btn btn-sm btn-warning text-white btn-edit' data-id='$soal->id'><i class='fas fa-pen'></i></button>
                ";
                // Add other action buttons as needed
            })
            ->rawColumns(['actions', 'pertanyaan'])
            ->toJson();
    }

    public function tiu()
    {
        return Inertia::render('Soal/Tiu', [
            'user' => auth()->user(),
            'soal' => Soal::with('kelas')->with('kategori_soal')->with('sub_kategori_soal')->where('kategori_soal_id', '=', 1)->get(),
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
            'edit' => Soal::with('pilihan')->where('id', $idSoal)->first(),
            'kelas' => Kelas::all(),
            'kategori_soal' => KategoriSoal::all(),
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

    // public function getSoals($kategori = null)
    // {
    //     if ($kategori) {
    //         $soals = Soal::with('kategori_soal')->where('kategori_soal_id', $kategori)->get();
    //     } else {
    //         $soals = Soal::with('kategori_soal')->where('kategori_soal_id', '!=', '100')->get();
    //     }
    //     return response()->json($soals);
    // }

    public function getSoals($idKelas = null)
    {
        if ($idKelas) {
            $soals = Soal::with('kelas')->with('kategori_soal')->where('kelas_id', $idKelas)->get();
        } else {
            $soals = Soal::with('kelas')->with('kategori_soal')->where('kelas_id', '!=', '1')->get();
        }
        return response()->json($soals);
    }

    public function import(Request $request)
    {
        $soal = $request->file('soal');
        $response = Excel::import(new SoalImport, $soal);

        return response()->json([
            'message' => 'soal berhasil dibuat',
        ]);
    }

    public function downloadFormat()
    {
        $file = public_path('formats/import.xlsx');

        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];

        return response()->download($file, 'format_import_data.xlsx', $headers);
    }
}
