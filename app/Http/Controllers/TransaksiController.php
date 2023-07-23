<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Payment\TripayController;
use App\Models\Cart;
use App\Models\Paket;
use App\Models\PrintList;
use App\Models\ProdukModel;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        $tripay = new TripayController();
        $paket = Paket::where('id', $request->id_paket)->first();

        $transaksi = $tripay->requestTransaksi($request->method, $paket, $request->total_pembayaran);

        Transaksi::create([
            'id_user' => auth()->user()->id,
            'id_paket' => $paket->id,
            'total_amount' => $transaksi->amount,
            'reference' => $transaksi->reference,
            'merchant_reference' => $transaksi->merchant_ref,
            'status' => $transaksi->status,
        ]);

        return response()->json([
            'message' => 'transaksi berhasil di buat',
            'reference' => $transaksi->reference,
        ]);
    }

    public function detailTransaksi($reference)
    {

        $tripay = new TripayController();
        $detail_transaksi = $tripay->detailTransaksi($reference);
        return Inertia::render('Pembayaran/Detail', [
            'user' => auth()->user(),
            'detail_transaksi' => $detail_transaksi
        ]);
        // return view('pages.halaman_depan.detail_transaksi', $data);
    }


    public function pembayaran()
    {
        return Inertia::render('Pembayaran/List', [
            'user' => auth()->user(),
            'transaksi' => Transaksi::with('paket')->where('id_user', auth()->user()->id)->get(),
        ]);
    }

    public function aktifkanTransaksi($reference)
    {
        $transaksi = Transaksi::where('reference', $reference)->update([
            'status' => 'paid'
        ]);

        return response()->json([
            'message' => 'transaksi berhasil di aktifkan',
        ]);
    }

    public function batalkanTransaksi($reference)
    {
        $transaksi = Transaksi::where('reference', $reference)->update([
            'status' => 'unpaid'
        ]);

        return response()->json([
            'message' => 'transaksi berhasil di batalkan',
        ]);
    }
}
