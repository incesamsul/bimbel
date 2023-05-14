<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class GeneralController extends Controller
{
    public function index()
    {
        return Inertia::render('Bantuan', [
            'user' => auth()->user()
        ]);
    }
}
