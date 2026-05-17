<?php


use Modules\Onboarding\Http\Controllers\Api\OnboardingAdminController;
use Orion\Facades\Orion;
use Illuminate\Support\Facades\Route;



Route::group([
    'as' => 'api.onboarding.',
    'prefix' => 'onboarding',
    'middleware' => ['auth:api'], // auth gælder for alle
], function ($router) {



    // Orion resource
    Orion::resource('onboarding', 'Api\OnboardingController')->except(['update', 'destroy']);

    

    // Accept/reject og admin-only actions
    Route::group(['middleware' => ['role:admin']], function () {


        Orion::resource('onboarding', 'Api\OnboardingController')->only(['update', 'destroy']);


        Route::post('{id}/accept', 'Api\OnboardingController@accept')->name('accept');


        Route::post('{id}/reject', 'Api\OnboardingController@reject')->name('reject');


    });


});
