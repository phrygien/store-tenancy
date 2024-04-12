<?php

use App\Models\Tenant;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    Route::view('stores', 'stores.index')
    ->middleware(['auth'])
    ->name('stores.index');

Route::view('stores/create', 'stores.create')
    ->middleware(['auth'])
    ->name('stores.create');

Volt::route('stores/{store}/edit', 'stores.edit-note')
    ->middleware(['auth'])
    ->name('stores.edit');

Route::get('stores/{store}', function (Tenant $tenant) {

    $user = $tenant->domains;

    return view('stores.view', ['tenant' => $tenant, 'user' => $user]);
})->name('stores.view');


require __DIR__.'/auth.php';
