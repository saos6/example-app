<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

Route::resource('affiliations', App\Http\Controllers\AffiliationController::class)->middleware(['auth', 'verified']);

Route::resource('people', App\Http\Controllers\PersonController::class)->middleware(['auth', 'verified']);

Route::resource('customers', App\Http\Controllers\CustomerController::class)->middleware(['auth', 'verified']);

Route::resource('products', App\Http\Controllers\ProductController::class)->middleware(['auth', 'verified']);

Route::resource('quotations', App\Http\Controllers\QuotationController::class)->middleware(['auth', 'verified']);
