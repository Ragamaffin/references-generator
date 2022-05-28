<?php

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

Auth::routes();

Route::redirect('/', \App\Providers\RouteServiceProvider::HOME);

Route::group(['middleware' => 'auth'], function(){
    // Routes for resources
    Route::get('/resources', [\App\Http\Controllers\ResourceController::class, 'index'])->name('resources.index');
    Route::get('/resources/search', [\App\Http\Controllers\ResourceController::class, 'search'])->name('resources.search');
    Route::get('/resources/create', [\App\Http\Controllers\ResourceController::class, 'create'])->name('resources.create');
    Route::post('/resources/create', [\App\Http\Controllers\ResourceController::class, 'store'])->name('resources.store');
    Route::get('/resources/{resource}', [\App\Http\Controllers\ResourceController::class, 'show'])->name('resources.show');
    Route::get('/resources/edit/{resource}', [\App\Http\Controllers\ResourceController::class, 'edit'])->name('resources.edit');
    Route::post('/resources/edit/{resource}', [\App\Http\Controllers\ResourceController::class, 'update'])->name('resources.update');
    Route::get('/resources/download/{resource}', [\App\Http\Controllers\ResourceController::class, 'downloadFile'])->name('resources.download');

// Routes for references
    Route::get('/references', [\App\Http\Controllers\ReferenceController::class, 'index'])->name('references.index');
    Route::get('/references/search', [\App\Http\Controllers\ReferenceController::class, 'search'])->name('references.search');
    Route::get('/references/create', [\App\Http\Controllers\ReferenceController::class, 'create'])->name('references.create');
    Route::post('/references/create', [\App\Http\Controllers\ReferenceController::class, 'store'])->name('references.store');
    Route::get('/references/{reference}', [\App\Http\Controllers\ReferenceController::class, 'show'])->name('references.show');
    Route::get('/references/edit/{reference}', [\App\Http\Controllers\ReferenceController::class, 'edit'])->name('references.edit');
    Route::post('/references/edit/{reference}', [\App\Http\Controllers\ReferenceController::class, 'update'])->name('references.update');
    Route::get('/references/generate/{reference}', [\App\Http\Controllers\ReferenceController::class, 'generate'])->name('references.generate');
    Route::get('/references/remove/{reference}/{resource}', [\App\Http\Controllers\ReferenceController::class, 'removeResource'])->name('references.removeResource');

// Routes for tags

});

