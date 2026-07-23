<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillController;

// Route::get('/', function () {
//     return view('invoice');
// });

Route::get('/',[BillController::class, 'create'])->name('bills.create');
Route::post('/bills',[BillController::class, 'store'])->name('bills.store');
Route::get('/bills/{bill}', [BillController::class, 'show'])->name('bills.show');
Route::get('/bills/{bill}/pdf',[BillController::class, 'generatePdf'])->name('bills.pdf');