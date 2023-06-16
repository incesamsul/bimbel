<?php

namespace App\Http\Controllers;

use App\Models\PaketVideoRelasi;
use Illuminate\Http\Request;

class PaketVideoRelasiController extends Controller
{
    public function addVideo(Request $request)
    {

        // Save the selectedIds to the database
        foreach ($request->id_materi_video as $id_materi_video) {
            PaketVideoRelasi::create([
                'id_materi_video' => $id_materi_video,
                'id_paket_video' => $request->id_paket_video,
            ]);
        }

        // Return a response to the client
        return response()->json(['message' => 'Data  berhasil di tambah']);
    }

    public function deleteVideo($idVideo)
    {

        // Retrieve the appropriate 'soal' data based on the 'id_tryout'
        $video = PaketVideoRelasi::where('id_materi_video', $idVideo)->delete();

        // Return the 'video' data as a JSON response
        return response()->json(['message' => 'Data video berhasil dihapus']);
    }

    public function getVideoPaket($idPaket)
    {
        $videos = PaketVideoRelasi::with('paket')->with('video')->where('id_paket_video', $idPaket)->get();
        return response()->json($videos);
    }
}
