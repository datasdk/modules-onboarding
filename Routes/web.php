<?php

use Illuminate\Support\Facades\Route;


Route::group([
    'as' => 'onboarding.',
    'prefix' => 'onboarding',
    "middleware" => ["web","auth","role:admin|editor|analyzer|guest"],
], function () {


    Route::resource('/', 'OnboardingController');

    Route::get('{id}/accept', 'OnboardingValidationController@accept')->name('accept');
    Route::get('{id}/reject', 'OnboardingValidationController@reject')->name('reject');




    Route::resource('badges', 'BadgeController');
    
 

    Route::get('settings/onboarding', "OnboardingSettingsController@index")->name("settings.index");
    
    Route::post('settings/onboarding', "OnboardingSettingsController@store")->name("settings.store");


});
