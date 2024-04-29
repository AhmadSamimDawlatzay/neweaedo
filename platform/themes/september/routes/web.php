<?php

use Botble\Theme\Facades\Theme;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Theme\September\Http\Controllers', 'middleware' => 'web'], function () {
    Theme::registerRoutes(function () {
        Route::get('ajax/cart', [
            'as' => 'public.ajax.cart',
            'uses' => 'SeptemberController@ajaxCart',
        ]);

        // project
        Route::get('project','SeptemberController@getProject');
        Route::get('project/{slug}','SeptemberController@getProjects');

        // volunteer
        Route::get('volunteer','SeptemberController@getVolunteer');
        Route::post('volunteer','SeptemberController@storeVolunteer')->name('volunteer');


        // Donate
        Route::get('donate','SeptemberController@getDonate');
        Route::post('donate','SeptemberController@storeDonate')->name('donate');

        // donation
        Route::get('donation','SeptemberController@getDonation');
        Route::get('donation/{slug}','SeptemberController@getDonations');

    });
});

Theme::routes();
