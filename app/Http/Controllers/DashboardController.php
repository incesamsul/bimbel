<?php

namespace App\Http\Controllers;

use App\Models\Latihan;
use App\Models\Paket;
use App\Models\PaketSoal;
use App\Models\PaketText;
use App\Models\PaketVideo;
use App\Models\Transaksi;
use App\Models\Tryout;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            return Inertia::render('Dashboard', [
                'user' => auth()->user(),
                'paket_aktif' => Transaksi::where('status', 'paid')->where('id_user', auth()->user()->id)->get(),
                'transaksi_paid' => Transaksi::where('status', 'paid')->where('id_user', auth()->user()->id)->get(),
                'transaksi_unpaid' => Transaksi::where('status', 'unpaid')->where('id_user', auth()->user()->id)->get(),
                'member' => User::where('role', 'member')->get(),
                'total_transaksi' => Transaksi::where('status', 'paid')->get(),
                'total_paket' => Paket::all(),
                'total_tryout' => Tryout::all(),
                'total_latihan' => Latihan::all(),
                'total_paket_video' => PaketVideo::all(),
                'total_paket_text' => PaketText::all(),
                'total_paket_latihan' => PaketVideo::all(),
                'total_paket_soal' => PaketSoal::all(),
            ]);
        } else {
            return Inertia::render('Dashboard', [
                'user' => auth()->user(),
                'paket_aktif' => Transaksi::where('status', 'paid')->where('id_user', auth()->user()->id)->get(),
                'transaksi_paid' => Transaksi::where('status', 'paid')->where('id_user', auth()->user()->id)->get(),
                'transaksi_unpaid' => Transaksi::where('status', 'unpaid')->where('id_user', auth()->user()->id)->get(),
            ]);
        }
    }
}
