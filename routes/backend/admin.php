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
Route::view('ordini','backend.ordini' )->name('ordini');
Route::view('raccolto','backend.collection' )->name('raccolto');
Route::view('coltivazioni','backend.cultivations' )->name('coltivazioni');

