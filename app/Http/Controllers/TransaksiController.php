<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Payment\TripayController;
use App\Models\Cart;
use App\Models\PrintList;
use App\Models\ProdukModel;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        $tripay = new TripayController();
        $cart = Cart::where('id_cart', $request->id_cart)->first();

        $transaksi = $tripay->requestTransaksi($request->method, $cart, $request->total_pembayaran);

        $printlist = PrintList::create([
            'id_user' => auth()->user()->id,
            'id_produk' => $cart->id_produk,
            'file' => $cart->file,
        ]);

        Transaksi::create([
            'id_user' => auth()->user()->id,
            'id_print_list' => $printlist->id,
            'reference' => $transaksi->reference,
            'merchant_reference' => $transaksi->merchant_ref,
            'total_amount' => $transaksi->amount,
            'status' => $transaksi->status,
        ]);

        Cart::where('id_cart', $request->id_cart)->delete();


        return redirect('/detail_transaksi/' . $transaksi->reference);
    }

    public function detailTransaksi($reference)
    {

        $tripay = new TripayController();
        $data['detail_transaksi'] = $tripay->detailTransaksi($reference);
        return view('pages.halaman_depan.detail_transaksi', $data);
    }
}
