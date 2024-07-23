<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WikiController;
use App\Http\Controllers\CredentialController;



Route::get('/', [WikiController::class, 'index']);
Route::post('/add-category', [WikiController::class, 'addCategory']);
Route::get('/wiki/{id}', [WikiController::class, 'wiki'])->name('wiki');
Route::get('/add-wiki/{id}', [WikiController::class, 'addWiki']);
Route::post('/wiki/store', [WikiController::class, 'storeWiki'])->name('wiki.store');
Route::get('/wiki-page/{id}', [WikiController::class, 'wikiPage']);

Route::get('/credentials', [CredentialController::class, 'index']);
