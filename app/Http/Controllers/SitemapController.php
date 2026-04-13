<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SitemapController extends Controller
{
    public function __invoke(): Response|View
    {
        $lastModified = now()->toAtomString();

        $urls = [
            [
                'loc' => route('site.home'),
                'changefreq' => 'weekly',
                'priority' => '1.0',
                'lastmod' => $lastModified,
            ],
            [
                'loc' => route('site.profile'),
                'changefreq' => 'monthly',
                'priority' => '0.9',
                'lastmod' => $lastModified,
            ],
            [
                'loc' => route('site.services'),
                'changefreq' => 'weekly',
                'priority' => '0.9',
                'lastmod' => $lastModified,
            ],
            [
                'loc' => route('site.contact'),
                'changefreq' => 'monthly',
                'priority' => '0.8',
                'lastmod' => $lastModified,
            ],
        ];

        foreach (Service::query()->whereNotNull('slug')->orderBy('sort_order')->pluck('slug') as $slug) {
            $urls[] = [
                'loc' => route('site.service.show', $slug),
                'changefreq' => 'monthly',
                'priority' => '0.8',
                'lastmod' => $lastModified,
            ];
        }

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }
}
