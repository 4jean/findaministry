<?php

namespace App\Providers;

use App\Models\Guide;
use App\Models\MinCat;
use App\Models\Ministry;
use App\MyHelper\Fam;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Only If Tables have been Migrated and DB Seeding is Complete

        $data['rcms'] = Ministry::orderBy('created_at', 'desc');
        $data['guides'] = Guide::orderby('created_at', 'desc');
        $data['countries'] = Fam::getAllCountries();
        $data['min_cats'] = MinCat::orderBy('name', 'asc')->get();
        $data['fb_page'] = Fam::getSetting('fb_page');
        $data['def_md'] = 'FIND A MINISTRY is a Platform for Finding Churches, Ministers, and Ministries and Helping them to Find You and Yours. Show your Ministry! Find Ministries!! Connect to Ministries. We live in a world sworn to dismantle all barriers to information, connectivity, and information (or idea) sharing.';

        View::share($data);
    }
}
