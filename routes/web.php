<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
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

    //employee
    Route::resource('employee', EmployeeController::class);
});



require __DIR__.'/auth.php';
