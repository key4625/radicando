<?php

use App\Http\Controllers\LocaleController;

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

Route::domain('radicando.it')->group(function () {
    
    Route::view('/','landlord.landing' );
    
    // Catch All Route
    Route::any('{any}', function () {
        abort(404);
    })->where('any', '.*');
});
Route::domain('straorto')->group(function () {
    
    Route::view('/','landlord.landing' );
    
    // Catch All Route
    Route::any('{any}', function () {
        abort(404);
    })->where('any', '.*');
});


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
