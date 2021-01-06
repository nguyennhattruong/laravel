<?php

namespace App\Modules\Domain\Services\Handle;

use App\Modules\Infrastructure\Core\Domain\ServiceHandle;
use Illuminate\Support\Facades\App;

class SitemapServiceHandle extends ServiceHandle
{
    public function storeSiteMap() {
        // create new sitemap object
        $sitemap = App::make("sitemap");

        // add items to the sitemap (url, date, priority, freq)
        $sitemap->add('a', '2012-08-25T20:10:00+02:00', '1.0');
        $sitemap->add('b', '2012-08-26T12:30:00+02:00', '0.9');

        // get all posts from db
//        $posts = DB::table('posts')->orderBy('created_at', 'desc')->get();

        // add every post to the sitemap
//        foreach ($posts as $post)
//        {
//            $sitemap->add($post->slug, $post->modified, $post->priority, $post->freq);
//        }

        // generate your sitemap (format, filename)
        $sitemap->store('xml', 'sitemap');
        // this will generate file mysitemap.xml to your public folder
    }
}