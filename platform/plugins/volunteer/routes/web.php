<?php

use Botble\Base\Facades\BaseHelper;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Botble\Volunteer\Http\Controllers', 'middleware' => ['web', 'core']], function () {

    Route::group(['prefix' => BaseHelper::getAdminPrefix(), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'volunteers', 'as' => 'volunteer.'], function () {
            Route::resource('', 'VolunteerController')->parameters(['' => 'volunteer']);
        });
    });

});
