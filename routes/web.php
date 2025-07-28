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

Route::get('affiliations/export-excel', [App\Http\Controllers\AffiliationController::class, 'exportExcel'])->name('affiliations.export.excel');

Route::resource('affiliations', App\Http\Controllers\AffiliationController::class);
Route::get('affiliations/export', [App\Http\Controllers\AffiliationController::class, 'export'])->name('affiliations.export');

Route::resource('people', App\Http\Controllers\PersonController::class);
Route::get('people/export/excel', [App\Http\Controllers\PersonController::class, 'exportExcel'])->name('people.export.excel');

Route::get('customers/export/excel', [App\Http\Controllers\CustomerController::class, 'exportExcel'])->name('customers.export.excel');

Route::resource('customers', App\Http\Controllers\CustomerController::class)->middleware(['auth', 'verified']);

Route::get('products/export/excel', [App\Http\Controllers\ProductController::class, 'exportExcel'])->name('products.export.excel');

Route::resource('products', App\Http\Controllers\ProductController::class)->middleware(['auth', 'verified']);

Route::get('quotations/export/excel', [App\Http\Controllers\QuotationController::class, 'exportExcel'])->name('quotations.export.excel');

Route::resource('quotations', App\Http\Controllers\QuotationController::class)->middleware(['auth', 'verified']);

Route::get('/quotations/{quotation}/pdf', [App\Http\Controllers\QuotationController::class, 'generatePdf'])->name('quotations.pdf');
