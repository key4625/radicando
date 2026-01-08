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

Route::domain('radicando.it')->group(function () {
    
    Route::get('/',[ContactController::class, 'index'] );
    //Route::post('/', [ContactController::class, 'save'])->name('contact.store');
    //Route::view('/landing','landlord.landing2' );
    Route::get('/landing', [ContactController::class, 'index']);
    //Route::post('/landing', [ContactController::class, 'save'])->name('contact.store');
    
    // Catch All Route
    Route::any('{any}', function () {
        abort(404);
    })->where('any', '.*');
});
Route::domain('www.radicando.it')->group(function () {
    
    Route::get('/',[ContactController::class, 'index'] );
    //Route::post('/', [ContactController::class, 'save'])->name('contact.store');
    //Route::view('/landing','landlord.landing2' );
    Route::get('/landing', [ContactController::class, 'index']);
    //Route::post('/landing', [ContactController::class, 'save'])->name('contact.store');
    
    // Catch All Route
    Route::any('{any}', function () {
        abort(404);
    })->where('any', '.*');
});
Route::domain('straorto')->group(function () {
    
    Route::get('/',[ContactController::class, 'index'] );
    //Route::post('/', [ContactController::class, 'save'])->name('contact.store');
    //Route::view('/landing','landlord.landing2' );
    Route::get('/landing', [ContactController::class, 'index']);
    Route::post('/landing', [ContactController::class, 'save'])->name('contact.store');
    
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

