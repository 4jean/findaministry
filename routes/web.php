<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// --------------------Test Routes ------------------
/*if(app()->environment() == 'local'){
    Route::get('/test', 'TestController@index');
}*/

Route::get('/test', 'TestController@index');

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', 'HomeController@about')->name('about');

Route::get('/contact', 'HomeController@contact')->name('contact');
Route::post('/contact_form', 'HomeController@contact_form')->name('contact_form');

Route::get('/sitemap', 'SitemapController@index')->name('sitemap');
Route::get('/sitemap.xml', 'SitemapController@show')->name('sitemap_show');

Route::get('/terms_of_use', 'HomeController@terms_of_use')->name('terms_of_use');
Route::get('/privacy_policy', 'HomeController@privacy_policy')->name('privacy_policy');



Route::group(['prefix' => 'ministries'], function() {

    Route::get('/', 'MinistryController@index')->name('ministries');

    Route::get('/categories/{cat?}', 'MinCatController@index')->name('categories');

});


/************************ AJAX ****************************/

Route::group(['prefix' => 'ajax'], function() {
    Route::get('get_country_states/{country_code}', 'AjaxController@get_country_states')->name('get_country_states');

    Route::post('min_names', 'AjaxController@min_names')->name('ajax.min_names');

    Route::group(['middleware' => 'auth'], function () {
        Route::post('set_fav_min', 'AjaxController@set_fav_min')->name('set_fav_min');

    });
});

/****************** AUTH **********************************/

Route::group(['middleware' => ['auth']], function () {

    Route::get('add_ministry', 'MinistryController@create')->name('add_ministry');
    Route::get('edit_ministry/{id}', 'MinistryController@edit')->name('edit_ministry');
    Route::post('store_ministry', 'MinistryController@store')->name('store_ministry');
    Route::put('update_ministry/{id}', 'MinistryController@update')->name('update_ministry');
    Route::post('set_min_page/{id}', 'MinistryController@set_min_page')->name('set_min_page');
    Route::get('thank_you', 'MinistryController@thank_you')->name('thank_you');

    Route::get('claim_ministry/{id}', 'ClaimController@index')->name('claim_ministry');
    Route::put('verify_ministry/{id}', 'ClaimController@verify_ministry')->name('verify_ministry');

    /*--------------------------- ----------------------- --------------------*/

    Route::get('my_profile', 'UserController@my_profile')->name('my_profile');

    Route::put('update_profile', 'UserController@update_profile')->name('update_profile');

    Route::put('update_password', 'UserController@update_password')->name('update_password');

    Route::get('my_ministries', 'UserController@my_ministries')->name('my_ministries');
    Route::get('my_account', 'UserController@my_ministries')->name('my_account');


    Route::group(['prefix' => 'ministries'], function() {

        Route::get('my_bookmarks', 'UserController@my_bookmarks')->name('my_bookmarks');
        Route::get('my_favorites', 'UserController@my_bookmarks');

    });

});

/*********************** GUIDES **********************/

Route::group(['prefix' => 'guides'], function() {

    Route::get('/', 'GuideController@index')->name('guides');
    Route::get('/index', 'GuideController@index')->name('guides');

    Route::get('how-to-verify-a-ministry', 'GuideController@verify_ministry')->name('guides.verify_ministry');
    Route::get('how-to-claim-a-ministry', 'GuideController@verify_ministry')->name('guides.claim_ministry');

    Route::get('choosing-a-page-name-for-your-ministry', 'GuideController@set_page_name')->name('set_page_name');

});

/**************** SEARCH ***********************/
Route::get('/search', 'SearchController@index')->name('search');
Route::post('/search', 'SearchController@process')->name('search.post');


Route::get('/{ministry}', 'MinistryController@show')->name('show_ministry');
