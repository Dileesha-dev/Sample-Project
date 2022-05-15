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
    /* Route::controller(CompanyController::class)->group(function(){
        Route::get('/companies', 'index')->name('company.index');
        Route::get('/companies/create', 'create')->name('company.create');
        Route::post('/companies/store', 'store')->name('company.store');
        Route::get('/companies/{id}', 'show')->name('company.show');
        Route::get('/companies/{id}/edit', 'edit')->name('company.edit');
        Route::put('/companies/{id}/update', 'update')->name('company.update');
        Route::delete('/companies/{id}/coverRemove/{coverId}', 'coverRemove')->name('company.coverRemove');
        Route::delete('/companies/{id}/delete', 'destroy')->name('company.delete');
    }); */
    Route::resource('companies', CompanyController::class)->names([
        'index' => 'company.index',
        'show' => 'company.show',
        'create' => 'company.create',
        'store' => 'company.store',
        'edit' => 'company.edit',
        'update' => 'company.update',
        'destroy' => 'company.delete',
    ]);
    Route::delete('/companies/{company}/coverRemove/{coverId}', [CompanyController::class, 'coverRemove'])->name('company.coverRemove');
});



require __DIR__.'/auth.php';
