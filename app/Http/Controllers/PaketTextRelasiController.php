<?php

namespace App\Http\Controllers;

use App\Models\PaketTextRelasi;
use App\Models\PaketVideoRelasi;
use Illuminate\Http\Request;

class PaketTextRelasiController extends Controller
{
    public function addText(Request $request)
    {

        // Save the selectedIds to the database
        foreach ($request->id_materi_text as $id_materi_text) {
            PaketTextRelasi::create([
                'id_materi_text' => $id_materi_text,
                'id_paket_text' => $request->id_paket_text,
            ]);
        }

        // Return a response to the client
        return response()->json(['message' => 'Data  berhasil di tambah']);
    }

    public function deleteText($idVideo)
    {

        // Retrieve the appropriate 'soal' data based on the 'id_tryout'
        $video = PaketTextRelasi::where('id_materi_text', $idVideo)->delete();

        // Return the 'video' data as a JSON response
        return response()->json(['message' => 'Data video berhasil dihapus']);
    }

    public function getTextPaket($idPaket)
    {
        $text = PaketTextRelasi::with('paket')->with('text')->where('id_paket_text', $idPaket)->get();
        return response()->json($text);
    }
}
