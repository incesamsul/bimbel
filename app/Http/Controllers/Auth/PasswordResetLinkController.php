<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResets;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Str;


class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::whereEmail($request->email)->first();
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'email tdk di kenali',
            ]);
        }

        PasswordResets::where('email', $request->email)->delete();

        $kodeReset = Str::random(200);
        PasswordResets::create([
            'email' => $user->email,
            'token' => $kodeReset,
            'created_at' => Carbon::now(),
        ]);

        $recipient = $user->email;
        $body = urlencode('ini adalah link reset password anda : ' . URL::to('/reset-password/' . $kodeReset));

        $scriptId = "AKfycbxjnnbthdE2TH7_QmS7jURPHd1CN-uWkgM0H0haKb9H4c4d_t2ViaWUowG3pfso3Fh3";
        $apiUrl = "https://script.google.com/macros/s/{$scriptId}/exec?recipient={$recipient}&body={$body}";

        $response = file_get_contents($apiUrl);


        throw ValidationException::withMessages([
            'email' => 'email reset password telah terkirim, tunggu beberapa menit jika email belum masuk secara otomatis',
        ]);
    }
}
