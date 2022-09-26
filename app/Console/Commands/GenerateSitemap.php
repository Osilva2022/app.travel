<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PostAll;
use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;
use DateTime;
use DB;

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
    protected $description = 'Generate the sitemap';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sitemapIndexes = [];

        $now = Carbon::now()->setTimezone(config('region.timezone'));
        // Create the general pages sitemap.
        $generalPagesSitemap = Sitemap::create();
        // Add homepage.
        $generalPagesSitemap->add(
            Url::create(config('app.url'))
                ->setLastModificationDate($now)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(1.0)
        );

        $generalPagesSitemap->add(
            Url::create(config('app.url').'/')
                ->setLastModificationDate($now)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(1.0)
        );

         // Add all categories pages.
        $categories = DB::select("SELECT CONCAT(d.slug,'/',C.slug) as slug FROM travel_destinations d JOIN travel_directory_category C;");

        foreach ($categories as $category) {
             $url = config('app.url').$category->slug;

             $generalPagesSitemap->add(
                 Url::create($url)
                     ->setLastModificationDate($now)
                     ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                     ->setPriority(0.8)
             );
        }

        // Add the sitemap to the indexes variable.
        $sitemapsIndex[] = '/sitemaps/pages_sitemap.xml';

        $postsSitemapCount = 1;
        // Create the posts sitemaps.
        $postsSite = PostALL::all()->chunk(500);

        foreach ($postsSite as $posts) {

            $postsSitemap = Sitemap::create();

            foreach ($posts as $post) {

                $lastMod = new DateTime($post->post_date);

                $postsSitemap->add(
                    Url::create($post->url)
                        ->setLastModificationDate($lastMod)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                        ->setPriority(0.4)
                );

            }
            // Add the sitemap to the indexes variable.
            $postsSitemap->writeToFile(public_path('sitemaps/posts_sitemap_'.$postsSitemapCount.'.xml'));
            $sitemapsIndex[] = '/sitemaps/posts_sitemap_'.$postsSitemapCount.'.xml';
            $postsSitemapCount++;

        }

         // Create the indexes sitemap.
         $indexesSitemap = SitemapIndex::create();
         // Add the indexes to the sitemap.
         foreach ($sitemapsIndex as $index) {
                $indexesSitemap->add($index);
         }
         // Create the sitemap to a file.
        $generalPagesSitemap->writeToFile(public_path('sitemaps/pages_sitemap.xml'));
        $indexesSitemap->writeToFile(public_path('sitemaps/sitemap.xml'));
    }
}
