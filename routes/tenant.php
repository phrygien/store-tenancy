<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    // Route::get('/', function () {
    //     return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    // });
    Route::view('/', 'app.welcome');

    Route::view('dashboard', 'app.dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    Route::view('profile', 'app.profile')
        ->middleware(['auth'])
        ->name('profile');

    Route::view('ecoles', 'schools.ecole.index')
    ->middleware(['auth'])
    ->name('ecoles.index');


    Route::view('ecoles/create', 'schools.ecole.create')
    ->middleware(['auth'])
    ->name('ecoles.create');


    require __DIR__.'/app-auth.php';
});
