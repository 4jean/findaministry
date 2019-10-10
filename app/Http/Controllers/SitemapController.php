<?php

namespace App\Http\Controllers;

use App\Repositories\GuideRepo;
use App\Repositories\MinistryRepo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SitemapController extends Controller
{
    protected $request;
    protected $min;
    protected $guide;

    public function __construct(Request $request, MinistryRepo $min, GuideRepo $guide)
    {
        $this->request = $request;
        $this->min = $min;
        $this->guide = $guide;
    }

    public function index()
    {
        // create new sitemap object
        $sitemap = App::make('sitemap');

        // set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
        // by default cache is disabled
        //$sitemap->setCache('laravel.sitemap', 60);

        // check if there is cached sitemap and build new only if is not
        if (!$sitemap->isCached()) {
            // add item to the sitemap (url, date, priority, freq)
            $sitemap->add(url('/'), Carbon::now(), '1.0', 'daily');
            $sitemap->add(url('/home'), Carbon::now(), '1.0', 'daily');
            $sitemap->add(url('/ministries'), Carbon::now(), '1.0', 'daily');
            $sitemap->add(url('/categories'), Carbon::now(), '0.9', 'monthly');
            $sitemap->add(url('/register'), Carbon::now(), '0.9', 'yearly');
            $sitemap->add(url('/login'), Carbon::now(), '0.9', 'yearly');
            $sitemap->add(url('/guides'), Carbon::now(), '0.9', 'monthly');
            $sitemap->add(url('/about'), Carbon::now(), '0.9', 'monthly');
            $sitemap->add(url('/contact'), Carbon::now(), '0.9', 'monthly');
            $sitemap->add(url('/search'), Carbon::now(), '0.9', 'monthly');
//            $sitemap->add(url('/sitemap'), Carbon::now(), '0.9', 'monthly');

            $mins = $this->min->all()->get(); // Get Ministries

            foreach ($mins as $min) {
                $images = array();
                    $images[] = array(
                        'url' => $min->photo,
                        'title' => $min->name,
                        'caption' => $min->name
                    );

                $sitemap->add($min->url, $min->updated_at, '0.9', 'monthly', $images);
            }

            $min_cats = $this->min->getAllCats(); // Get Ministries Cats
            foreach ($min_cats as $mc) {

                $sitemap->add(route('categories', $mc->slug), $mc->updated_at, '0.7', 'monthly');
            }

            $guides = $this->guide->all()->get(); // Get Ministries Guides
            foreach ($guides as $g) {
                    $url = '/guides/'.$g->slug;
                $sitemap->add(url($url), Carbon::now(), '0.8', 'monthly');
            }

            $sitemap->add(url('/terms_of_use'), Carbon::now(), '0.5', 'monthly');
            $sitemap->add(url('/privacy_policy'), Carbon::now(), '0.5', 'monthly');
        }

        // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
        return $sitemap->render('xml');
    }
}