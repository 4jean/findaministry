<?php

Route::group(['namespace' => 'Admin', 'middleware' => 'admin'], function () {
    Route::get('/', 'HomeController@index')->name('cj');

    Route::group(['prefix' => 'ministries', ], function(){
        Route::get('/', 'CJMinistryController@index')->name('cj_ministries');
        Route::get('edit/{min}', 'CJMinistryController@edit')->name('cj_edit_min');
        Route::put('update/{min}', 'CJMinistryController@update')->name('cj_update_min');
        Route::delete('delete/{min}', 'CJMinistryController@delete')->name('cj_delete_min');
        Route::post('cj_set_min_page/{min}', 'CJMinistryController@set_min_page')->name('cj_set_min_page');
        Route::get('set_hq/{min}', 'CJMinistryController@setHQ')->name('cj_set_hq');
        Route::get('verify/{min}', 'CJMinistryController@verify')->name('cj_verify_min');
    });

    //        Claims' Routes
    Route::group(['prefix' => 'claims'], function() {
        Route::get('/{min?}', 'CJClaimController@index')->name('cj_claims');
        Route::get('/{claim_id}/download', 'CJClaimController@download_file')->name('cj_claim_download_file');
        Route::get('/{claim_id}/file', 'CJClaimController@view_file')->name('cj_claim_view_file');
        Route::put('approve/{claim_id}', 'CJClaimController@approve')->name('cj_claim_approve');
        Route::delete('/{claim_id}', 'CJClaimController@delete')->name('cj_claim_delete');
    });

    });
