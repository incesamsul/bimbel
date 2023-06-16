<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Payment\TripayController;
use App\Models\Paket;
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
}
