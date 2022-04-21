<?php

use App\Http\Controllers\Backend\AnimalController;
use App\Http\Controllers\Backend\DashboardController;
use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\Backend\PlantController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SettingController;

// All route names are prefixed with 'admin.'.


Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
    });

Route::middleware('tenant')->group(function() {
    Route::resource('piante',PlantController::class);
    Route::resource('animali',AnimalController::class);
    Route::resource('prodotti',ProductController::class);
    //Route::view('piante','backend.plants' )->name('piante');
    Route::view('terreni','backend.terreni' )->name('terreni')->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Terreni'), route('admin.terreni'));
    });
    Route::view('terreno','backend.terreni_sat' )->name('terreno')->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.terreni', route('admin.terreni'))->push(__('Informazioni terreno'), route('admin.terreno'));
    });
    Route::view('ordini','backend.ordini' )->name('ordini')->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Ordini'), route('admin.ordini'));
    });
    Route::view('raccolto','backend.collection' )->name('raccolto')->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Raccolto'), route('admin.raccolto'));
    });
    Route::view('coltivazioni','backend.cultivations' )->name('coltivazioni')->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Coltivazioni'), route('admin.coltivazioni'));
    });
    Route::view('lotti','backend.lots' )->name('lotti')->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.terreni', route('admin.terreni'))->push(__('Lotti'), route('admin.lotti'));
    });
    Route::view('diario','backend.diario' )->name('diario')->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Diario'), route('admin.diario'));
    });

    Route::get('settings', 'App\Http\Controllers\Backend\SettingController@index')->name('settings');
    Route::post('settings/update', 'App\Http\Controllers\Backend\SettingController@updateAll');
});

