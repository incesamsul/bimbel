<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Payment\TripayController;
use App\Models\Diskon;
use App\Models\Paket;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Yajra\DataTables\Facades\DataTables;

class PembayaranController extends Controller
{
    public function index($idPaket)
    {
        $tripay = new TripayController();
        $channels = $tripay->getPaymentChannels();
        return Inertia::render('Pembayaran/Index', [
            'user' => auth()->user(),
            'channels' => $channels,
            'paket' => Paket::where('id', $idPaket)->first(),
            'diskon' => Diskon::all()->first() ? Diskon::all()->first()->persen : 0,
            'paket_saya' => Transaksi::with('paket')->where('id_user', auth()->user()->id)->where('status', 'paid')->get(),
        ]);
    }

    public function listPembayaran()
    {
        return Inertia::render('Pembayaran/ListPembayaran', [
            'user' => auth()->user(),
            // 'transaksi' => Transaksi::with('paket')->get(),
        ]);
    }

    public function pembayaranDatatable()
    {

        $reference = isset($_GET['reference']) ? $_GET['reference'] : '';

        $query = Transaksi::with('paket');

        if ($reference !== '') {
            $query->where('kelas_id', 'like', '%' . $reference . '%');
        }


        return DataTables::eloquent($query)
            ->addColumn('paket', function ($soal) {
                return $soal->paket->nama_paket;
            })
            ->addColumn('status', function ($soal) {
                $badgeClass = $soal->status == 'paid' ? 'badge-success' : 'badge-danger';
                return '<span class="badge ' . $badgeClass . '">' . e($soal->status) . '</span>';
            })

            ->addColumn('amount', function ($soal) {
                return "Rp. " . number_format($soal->total_amount, 0, ',', '.');
            })
            ->addColumn('detail', function ($soal) {
                return '<a target="_blank" href="/detail_transaksi/' . $soal->reference . '">Lihat</a>';
            })
            ->addColumn('actions', function ($soal) {
                return '<span data-reference="' . $soal->reference . '" ' . ($soal->status == 'unpaid' ? 'onclick="aktifkanTransaksi(' . $soal->reference . ')" class="badge badge-primary btn-aktifkan-transaksi cursor-pointer"' : 'onclick="batalkanTransaksi(' . $soal->reference . ')" class="btn-batalkan-transaksi badge badge-warning cursor-pointer"') . '>'
                    . ($soal->status == 'unpaid' ? 'aktifkan' : 'batalkan') .
                    '</span>';
            })

            ->rawColumns(['status', 'amount', 'detail', 'actions'])
            ->toJson();
    }
}
