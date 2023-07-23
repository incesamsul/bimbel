<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DiskonController extends Controller
{
    public function index()
    {
        return Inertia::render('Diskon/Index', [
            'user' => auth()->user(),
            'edit' => Diskon::all()->first(),
        ]);
    }

    public function store(Request $request)
    {

        Diskon::create([
            'persen' => $request->persen,
        ])->id;

        return response()->json([
            'message' => 'diskon berhasil dibuat',
        ]);
    }

    public function update(Request $request)
    {

        Diskon::where('id', $request->id)->update([
            'persen' => $request->persen,
        ]);

        return response()->json([
            'message' => 'diskon berhasil dibuah',
        ]);
    }
}
