<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MainDashboard\users\userController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\MainDashboard\clients\AdminClientsController;
use App\Http\Controllers\MainDashboard\Maintenance\AdminMaintenanceController;
use App\Http\Controllers\CompanyDashboard\Maintenance\CompanyMaintenanceController;
use App\Http\Controllers\MainDashboard\brands\AdminBrandsController;
use App\Http\Controllers\MainDashboard\offers\AdminOffersController;
use App\Http\Controllers\MainDashboard\types\AdminTypesController;

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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Route::get('/', function () {
            return redirect()->route('login');
        });

        Route::get('/register', function () {
            return redirect()->route('login');
        });


        Auth::routes(['register' => false]);

        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');



        Route::group(['prefix' => 'users', 'middleware' => 'auth'], function () {
            Route::get('/', [userController::class, 'index'])->middleware('SuperAdmin');
            // Route::get('/{id}', [userController::class, 'show'])->middleware('Admin');
            Route::post('/store', [userController::class, 'store'])->middleware('SuperAdmin')->name('users.store');
            Route::post('/update/{id}', [userController::class, 'update'])->middleware('Admin')->name('users.update');
            Route::post('/updateRole/{user}', [userController::class, 'updateRole'])->middleware('SuperAdmin');
            Route::delete('/{id}', [userController::class, 'destroy'])->middleware('SuperAdmin')->name('users.delete');
        });




        Route::group(['prefix' => 'clients', 'middleware' => ['auth', 'Admin']], function () {
            Route::get('/', [AdminClientsController::class, 'index']);
            Route::post('/{client}', [AdminClientsController::class, 'update']);
            Route::delete('/{client}', [AdminClientsController::class, 'destroy']);
            Route::post('/search', [AdminClientsController::class, 'search']);
        });
    }
);

Route::get('/maintenance', [AdminMaintenanceController::class, 'index'])
    // ->middleware('Admin')
;

Route::post('/maintenance/assign/{maintenance}', [AdminMaintenanceController::class, 'assign']);
    // ->middleware('Admin')
;

Route::post('/maintenance/{maintenance}', [AdminMaintenanceController::class, 'update'])
    // ->middleware('Admin')
;

Route::delete('/maintenance/{maintenance}', [AdminMaintenanceController::class, 'destroy']);
    // ->middleware('Admin')
;


// Company routes -------------------------------------------------------------------------
Route::get('/company/maintenance', [CompanyMaintenanceController::class, 'index'])
    // ->middleware('CompanyAdmin')
;

Route::get('/company/maintenance/completed', [CompanyMaintenanceController::class, 'completed']);
    // ->middleware('CompanyAdmin')
;

Route::post('/company/maintenance/{maintenance}', [CompanyMaintenanceController::class, 'update']);
    // ->middleware('CompanyAdmin')
;

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// brands routes -------------------------------------------------------------------------
Route::group([
    'prefix' => 'brands'
    // ,'middleware' => ['auth', 'Admin']
], function () {
    Route::get('/', [AdminBrandsController::class, 'index']);
    Route::post('/', [AdminBrandsController::class, 'store']);
    Route::post('/{brand}', [AdminBrandsController::class, 'update']);
    Route::delete('/{brand}', [AdminBrandsController::class, 'destroy']);
});

// brands routes -------------------------------------------------------------------------
Route::group([
    'prefix' => 'types'
    // ,'middleware' => ['auth', 'Admin']
], function () {
    Route::get('/', [AdminTypesController::class, 'index']);
    Route::post('/', [AdminTypesController::class, 'store']);
    Route::post('/{type}', [AdminTypesController::class, 'update']);
    Route::delete('/{type}', [AdminTypesController::class, 'destroy']);
});
// Route::post('/offers', [AdminOffersController::class, 'store']);
// offers routes -------------------------------------------------------------------------
Route::group([
    'prefix' => 'offer'
    // ,'middleware' => ['auth', 'Admin']
], function () {
    Route::get('/', [AdminOffersController::class, 'index']);
    Route::post('/', [AdminOffersController::class, 'store']);
    Route::post('/{offer}', [AdminOffersController::class, 'update']);
    Route::delete('/{offer}', [AdminOffersController::class, 'destroy']);
});

