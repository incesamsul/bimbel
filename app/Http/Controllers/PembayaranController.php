<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Payment\TripayController;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PembayaranController extends Controller
{
    public function index()
    {
        $tripay = new TripayController();
        $channels = $tripay->getPaymentChannels();
        return Inertia::render('Pembayaran', [
            'user' => auth()->user(),
            'channels' => $channels
        ]);
    }
}
