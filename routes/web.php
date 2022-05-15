<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //profile
    Route::get('/profile', function() {
        return view('profile');
    })->name('profile.show');
    Route::put('/profile', [UserController::class, 'update'])->name('profile.update');

    //company
    Route::controller(CompanyController::class)->group(function(){
        Route::get('/companies', 'index')->name('company.index');
        Route::get('/companies/create', 'create')->name('company.create');
        Route::post('/companies/store', 'store')->name('company.store');
        Route::get('/companies/{id}', 'show')->name('company.show');
    });
});



require __DIR__.'/auth.php';
