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
                'member' => User::where('role', 'member')->get()->count(),
                'total_transaksi' => Transaksi::where('status', 'paid')->sum('total_amount'),
                'total_paket' => Paket::all()->count(),
                'total_tryout' => Tryout::all()->count(),
                'total_latihan' => Latihan::all()->count(),
                'total_paket_video' => PaketVideo::all()->count(),
                'total_paket_text' => PaketText::all()->count(),
                'total_paket_latihan' => PaketVideo::all()->count(),
                'total_paket_soal' => PaketSoal::all()->count(),
            ]);
        } else {
            return Inertia::render('Dashboard', [
                'user' => auth()->user(),
                'paket_aktif' => Transaksi::where('status', 'paid')->where('id_user', auth()->user()->id)->get()->count(),
                'transaksi_paid' => Transaksi::where('status', 'paid')->where('id_user', auth()->user()->id)->get()->count(),
                'transaksi_unpaid' => Transaksi::where('status', 'unpaid')->where('id_user', auth()->user()->id)->get()->count(),
            ]);
        }
    }
}
