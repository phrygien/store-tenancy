<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\Commune;
use App\Models\District;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Models\Province;
use App\Models\Region;
use Illuminate\Http\Request;

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



    Route::get('/provinces', function (Request $request) {
        // getting initial selected values
        $selected = json_decode($request->get('selected', ''), true);

        return Province::query()
            ->when(
                $search = $request->get('search'),
                fn ($query) => $query->where('nom', 'like', "%{$search}%")
            )
            ->when(!$search && $selected, function ($query) use ($selected) {
                $query->whereIn('id', $selected)
                    ->orWhere(function ($query) use ($selected) {
                        $query->whereNotIn('id', $selected)
                            ->orderBy('nom');
                    });
            })
            ->limit(10)
            ->get()
            // mapping to the expected format
            ->map(fn (Province $province) => $province->only('id', 'nom'));
    })->name('api.provinces.index');

    // get region by province_id
    Route::get('/regions', function (Request $request) {
        $selected = json_decode($request->get('selected', ''), true);
        $province_id = $request->get('province_id');

        return Region::query()
            ->when(
                $search = $request->get('search'),
                fn ($query) => $query->where('nom', 'like', "%{$search}%")
            )
            ->when(!$search && $selected, function ($query) use ($selected) {
                $query->whereIn('id', $selected)
                    ->orWhere(function ($query) use ($selected) {
                        $query->whereNotIn('id', $selected)
                            ->orderBy('nom');
                    });
            })
            ->where('id_province', $province_id)
            //->limit(10)
            ->get()
            ->map(fn (Region $region) => $region->only('id', 'nom'));
    })->name('api.regions.index');

    // get district by regionId
    Route::get('/districts', function (Request $request) {
        $selected = json_decode($request->get('selected', ''), true);
        $id_region = $request->get('id_region');

        return District::query()
            ->when(
                $search = $request->get('search'),
                fn ($query) => $query->where('libelle', 'like', "%{$search}%")
            )
            ->when(!$search && $selected, function ($query) use ($selected) {
                $query->whereIn('id', $selected)
                    ->orWhere(function ($query) use ($selected) {
                        $query->whereNotIn('id', $selected)
                            ->orderBy('libelle');
                    });
            })
            ->where('id_region', $id_region)
            //->limit(10)
            ->get()
            ->map(fn (District $region) => $region->only('id', 'libelle'));
    })->name('api.districts.index');

    // get commune by district
    Route::get('/communes', function (Request $request) {
        $selected = json_decode($request->get('selected', ''), true);
        $district_id = $request->get('district_id');

        return Commune::query()
            ->when(
                $search = $request->get('search'),
                fn ($query) => $query->where('nom', 'like', "%{$search}%")
            )
            ->when(!$search && $selected, function ($query) use ($selected) {
                $query->whereIn('id', $selected)
                    ->orWhere(function ($query) use ($selected) {
                        $query->whereNotIn('id', $selected)
                            ->orderBy('nom');
                    });
            })
            ->where('id_district', $district_id)
            //->limit(10)
            ->get()
            ->map(fn (Commune $region) => $region->only('id', 'nom'));
    })->name('api.communes.index');


    Route::get('/categories', function (Request $request) {
        // getting initial selected values
        $selected = json_decode($request->get('selected', ''), true);

        return Category::query()
            ->when(
                $search = $request->get('search'),
                fn ($query) => $query->where('name', 'like', "%{$search}%")
            )
            ->when(!$search && $selected, function ($query) use ($selected) {
                $query->whereIn('id', $selected)
                    ->orWhere(function ($query) use ($selected) {
                        $query->whereNotIn('id', $selected)
                            ->orderBy('name');
                    });
            })
            ->limit(10)
            ->get()
            // mapping to the expected format
            ->map(fn (Category $category) => $category->only('id', 'name'));
    })->name('api.categories.all');

    require __DIR__.'/app-auth.php';
});
