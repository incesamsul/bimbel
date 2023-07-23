<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResets;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): Response
    {
        return Inertia::render('Auth/ResetPassword', [
            'email' => $request->email,
            'token' => $request->route('token'),
        ]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function store(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'token' => 'required',
    //         'email' => 'required|email',
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //     ]);

    //     // Here we will attempt to reset the user's password. If it is successful we
    //     // will update the password on an actual user model and persist it to the
    //     // database. Otherwise we will parse the error and return the response.
    //     $status = Password::reset(
    //         $request->only('email', 'password', 'password_confirmation', 'token'),
    //         function ($user) use ($request) {
    //             $user->forceFill([
    //                 'password' => Hash::make($request->password),
    //                 'remember_token' => Str::random(60),
    //             ])->save();

    //             event(new PasswordReset($user));
    //         }
    //     );

    //     // If the password was successfully reset, we will redirect the user back to
    //     // the application's home authenticated view. If there is an error we can
    //     // redirect them back to where they came from with their error message.
    //     if ($status == Password::PASSWORD_RESET) {
    //         return redirect()->route('login')->with('status', __($status));
    //     }

    //     throw ValidationException::withMessages([
    //         'email' => [trans($status)],
    //     ]);
    // }


    public function store(Request $request): RedirectResponse
    {

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $passwordResetData = PasswordResets::where('token', $request->token)->first();
            if (!$passwordResetData || Carbon::now()->subMinutes(10) > $passwordResetData->created_at) {
                PasswordResets::where('token', $request->token)->delete();
                throw ValidationException::withMessages([
                    'email' => 'link sudah expired',
                ]);
            } else {
                if ($request->password == $request->password_confirmation) {
                    PasswordResets::where('token', $request->token)->delete();
                    $user->update([
                        'password' => bcrypt($request->password)
                    ]);
                    return redirect()->route('login')->with('status', 'password berhasil di reset');
                } else {
                    throw ValidationException::withMessages([
                        'email' => 'konfirmasi password salah',
                    ]);
                }
            }
        } else {
            throw ValidationException::withMessages([
                'email' => 'email tidak sesuai',
            ]);
        }
    }
}
