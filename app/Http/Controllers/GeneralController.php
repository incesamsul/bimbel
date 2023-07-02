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


    public function test()
    {
        return Inertia::render('Test', [
            'user' => auth()->user()
        ]);
    }

    public function convertLatex($latex)
    {
        $latex = '\frac{1}{2}\cdot10\ +\ \sum_2^f';
        $data['latex'] = $latex;
        $html = view('latex', $data)->render();
        return $html;
        $sanitizedHtml = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML($sanitizedHtml);
        libxml_clear_errors();

        $xpath = new \DOMXPath($doc);
        $spanElement = $xpath->query('//span[@id="math"]')->item(0);
        $latexHtml = $doc->saveHTML($spanElement);

        return $latexHtml;
    }
}
