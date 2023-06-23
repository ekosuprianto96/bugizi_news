<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generating the sitemap for the site';


    public function handle()
    {
        SitemapGenerator::create('http://127.0.0.1:8000/admin/dashboard')->writeToFile(public_path('sitemap.xml'));
        $this->info('The sitemap has been generated');
    }
}
