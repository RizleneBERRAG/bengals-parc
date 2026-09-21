<?php

use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\CatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\KittenController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/',                        [PageController::class, 'home'])->name('home');

Route::get('/chatons',                 [KittenController::class, 'index'])->name('kittens.index');
Route::get('/chatons/{kitten}',        [KittenController::class, 'show'])->name('kittens.show');

Route::get('/elevage',                 [CatController::class, 'index'])->name('cats.index');
Route::get('/elevage/{cat}',           [CatController::class, 'show'])->name('cats.show');

Route::get('/le-bengal',               [PageController::class, 'breed'])->name('breed');
Route::get('/galerie',                 [PageController::class, 'gallery'])->name('gallery');
Route::get('/questions',               [PageController::class, 'faq'])->name('faq');
Route::get('/contact',                 [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,60')   // 5 messages par heure et par IP
    ->name('contact.store');
Route::get('/mentions-legales',        [PageController::class, 'legal'])->name('legal');

Route::get('/adopter',                 [AdoptionController::class, 'create'])->name('adoption.create');
Route::post('/adopter', [AdoptionController::class, 'store'])
    ->middleware('throttle:5,60')   // 5 demandes par heure et par IP
    ->name('adoption.store');
