<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ResourceController;
use \App\Http\Controllers\ReferenceController;
use \App\Http\Controllers\TagController;
use \App\Http\Controllers\UserController;

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
    Route::get('/resources', [ResourceController::class, 'index'])->name('resources.index');
    Route::get('/resources/search', [ResourceController::class, 'search'])->name('resources.search');
    Route::get('/resources/create', [ResourceController::class, 'create'])->name('resources.create');
    Route::post('/resources/create', [ResourceController::class, 'store'])->name('resources.store');
    Route::get('/resources/{resource}', [ResourceController::class, 'show'])->name('resources.show');
    Route::get('/resources/edit/{resource}', [ResourceController::class, 'edit'])->name('resources.edit');
    Route::post('/resources/edit/{resource}', [ResourceController::class, 'update'])->name('resources.update');
    Route::get('/resources/download/{resource}', [ResourceController::class, 'downloadFile'])->name('resources.download');

// Routes for references
    Route::get('/references', [ReferenceController::class, 'index'])->name('references.index');
    Route::get('/references/search', [ReferenceController::class, 'search'])->name('references.search');
    Route::get('/references/create', [ReferenceController::class, 'create'])->name('references.create');
    Route::post('/references/create', [ReferenceController::class, 'store'])->name('references.store');
    Route::get('/references/{reference}', [ReferenceController::class, 'show'])->name('references.show');
    Route::get('/references/edit/{reference}', [ReferenceController::class, 'edit'])->name('references.edit');
    Route::post('/references/edit/{reference}', [ReferenceController::class, 'update'])->name('references.update');
    Route::get('/references/generate/{reference}', [ReferenceController::class, 'generate'])->name('references.generate');
    Route::get('/references/toggleStatus/{reference}', [ReferenceController::class, 'toggleStatus'])->name('references.toggleStatus');
    Route::post('/references/addResource/{resource}', [ReferenceController::class, 'addResourceToReference'])->name('references.addResource');
    Route::get('/references/remove/{reference}/{resource}', [ReferenceController::class, 'removeResource'])->name('references.removeResource');

// Routes for users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

// Routes for tags
    Route::post('/tags/create', [TagController::class, 'store'])->name('tags.store');
});

