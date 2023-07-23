<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TripayController extends Controller
{
    public function getPaymentChannels()
    {

        $apiKey = env('TRIPAY_API_KEY');

        $payload = ['code' => 'BRIVA'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api/merchant/payment-channel',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ));

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response)->data;

        return $response ? $response : $error;
    }

    public function requestTransaksi($method, $paket, $totalPembayaran)
    {

        $apiKey       = env('TRIPAY_API_KEY');
        $privateKey   = env('TRIPAY_PRIVATE_KEY');
        $merchantCode = env('TRIPAY_MERCHANT_CODE');
        $merchantRef  = 'SAM-' . time();
        $amount       = $totalPembayaran;
        $user = auth()->user();
        $data = [
            'method'         => $method,
            'merchant_ref'   => $merchantRef,
            'amount'         => $amount,
            'customer_name'  => $user->name,
            'customer_email' => $user->email,
            'customer_phone' => $user->whatsapp,
            'order_items'    => [
                [
                    'name'        => $paket->nama_paket,
                    'price'       => $totalPembayaran,
                    'quantity'    => 1,
                ]
            ],
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature'    => hash_hmac('sha256', $merchantCode . $merchantRef . $amount, $privateKey)
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api/transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        return $response ? json_decode($response)->data : $error;
    }

    public function detailTransaksi($reference)
    {


        $apiKey = env('TRIPAY_API_KEY');

        $payload = ['reference'    => $reference];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api/transaction/detail?' . http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response)->data;

        return $response ? $response : $error;
    }
}
