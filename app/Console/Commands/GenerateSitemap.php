<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update sitemap links';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $staticUrls = [
            [
                'loc' => url('/'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '1.0',
            ],
        ];

        $dinamicUrls = [];

        /* Dinamic urls example

            Model::select(
                    'title',
                    'updated_at'
                )
                ->get()
                ->map(function ($el) {
                    return [
                        'loc' => url("/url/{$el->title}"),
                        'lastmod' => $el->updated_at->toAtomString(),
                        'changefreq' => 'daily',
                        'priority' => '0.7',
                    ];
                })
                ->toArray();

        */

        $urls = array_merge($staticUrls, $dinamicUrls);
        $sitemapContent = view('sitemap', compact('urls'))->render();
        File::put(public_path('sitemap.xml'), $sitemapContent);
        $this->info('Sitemap aggiornata con successo!');

    }
}
