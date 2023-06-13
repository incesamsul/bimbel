<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Transaksi;
use App\Http\Controllers\Controller;


class TripayCallbackController extends Controller
{
    // Isi dengan private key anda
    protected $privateKey = 'vWhCP-l7wvT-K0LHS-RVvdC-5kH6b';

    public function handle(Request $request)
    {
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE');
        $json = $request->getContent();
        $signature = hash_hmac('sha256', $json, $this->privateKey);

        if ($signature !== (string) $callbackSignature) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid signature',
            ]);
        }

        if ('payment_status' !== (string) $request->server('HTTP_X_CALLBACK_EVENT')) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid callback event, no action was taken',
            ]);
        }

        $data = json_decode($json);

        if (JSON_ERROR_NONE !== json_last_error()) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid data sent by tripay',
            ]);
        }

        $reference = $data->reference;
        $status = strtoupper((string) $data->status);

        /*
        |--------------------------------------------------------------------------
        | Proses callback untuk closed payment
        |--------------------------------------------------------------------------
        */

        if (1 === (int) $data->is_closed_payment) {
            $transaksi = Transaksi::where('reference', $reference)
                ->where('status', '!=', 'paid')
                ->first();

            if (!$transaksi) {
                return Response::json([
                    'success' => false,
                    'message' => 'No transaksi found or already paid: ' . $reference,
                ]);
            }

            Transaksi::where('reference', $reference)->update(['status' => $status]);
            return Response::json(['success' => true]);
        }


        /*
        |--------------------------------------------------------------------------
        | Proses callback untuk open payment
        |--------------------------------------------------------------------------
        */
    }
}
