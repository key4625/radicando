<?php

use App\Http\Controllers\Backend\DashboardController;
use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\Backend\PlantController;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
    });
Route::resource('piante',PlantController::class);
//Route::view('piante','backend.plants' )->name('piante');
Route::view('terreni','backend.terreni' )->name('terreni')->breadcrumbs(function (Trail $trail) {
    $trail->push(__('Terreni'), route('admin.terreni'));
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
    $trail->push(__('Lotti'), route('admin.lotti'));
});
Route::view('diario','backend.diario' )->name('diario')->breadcrumbs(function (Trail $trail) {
    $trail->push(__('Diario'), route('admin.diario'));
});

