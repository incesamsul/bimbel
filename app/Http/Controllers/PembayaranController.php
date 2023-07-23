<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Payment\TripayController;
use App\Models\Paket;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PembayaranController extends Controller
{
    public function index($idPaket)
    {
        $tripay = new TripayController();
        $channels = $tripay->getPaymentChannels();
        return Inertia::render('Pembayaran/Index', [
            'user' => auth()->user(),
            'channels' => $channels,
            'paket' => Paket::where('id', $idPaket)->first()
        ]);
    }

    public function listPembayaran()
    {
        return Inertia::render('Pembayaran/ListPembayaran', [
            'user' => auth()->user(),
            'transaksi' => Transaksi::with('paket')->get(),
        ]);
    }
}
