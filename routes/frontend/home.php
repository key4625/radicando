<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\TermsController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', [HomeController::class, 'index'])
    ->name('index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('frontend.index'));
    });

    Route::get('/ordina', [HomeController::class, 'order'])
    ->name('order')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Ordina'), route('frontend.order'));
    });

    Route::get('/visita', [HomeController::class, 'visit'])
    ->name('visit')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Visita'), route('frontend.visit'));
    });

Route::get('terms', [TermsController::class, 'index'])
    ->name('pages.terms')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Terms & Conditions'), route('frontend.pages.terms'));
    });
