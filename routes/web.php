<?php

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ContactController;
/*
 * Global Routes
 *
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
Route::get('lang/{lang}', [LocaleController::class, 'change'])->name('locale.change');

/*
 * Frontend Routes
 */

Route::domain('{landing_domain}')->group(function () {
    
    Route::get('/',[ContactController::class, 'index'] );
    Route::post('/', [ContactController::class, 'save'])->name('contact.store');
    //Route::view('/landing','landlord.landing2' );
    Route::get('/landing', [ContactController::class, 'index']);
    Route::post('/landing', [ContactController::class, 'save'])->name('contact.landing.store');
    
    // Catch All Route
    Route::any('{any}', function () {
        abort(404);
    })->where('any', '.*');
})->where('landing_domain', 'radicando\.it|www\.radicando\.it|straorto');


    Route::group(['as' => 'frontend.'], function () {
        includeRouteFiles(__DIR__.'/frontend/');
    });

    /*
    * Backend Routes
    *
    * These routes can only be accessed by users with type `admin`
    */
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
        includeRouteFiles(__DIR__.'/backend/');
    });

