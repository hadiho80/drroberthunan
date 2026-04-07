<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\View\View;

class SitemapController extends Controller
{
    public function __invoke(): Response|View
    {
        return response()
            ->view('sitemap', ['lastModified' => now()->toAtomString()])
            ->header('Content-Type', 'application/xml');
    }
}
