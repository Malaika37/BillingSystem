<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;

// Route::get('/', function () {
//     return view('invoice');
// });

Route::get('/',[BillController::class, 'create'])->name('bills.create');
Route::post('/bills',[BillController::class, 'store'])->name('bills.store');
Route::get('/bills/{bill}', [BillController::class, 'show'])->name('bills.show');
Route::get('/bills/{bill}/pdf',[BillController::class, 'generatePdf'])->name('bills.pdf');
Route::post('/bills/{bill}/whatsapp', [BillController::class, 'sendWhatsApp'])->name('bills.whatsapp');
Route::get('/customers',[CustomerController::class, 'index'])->name('customers.index');
Route::get('/customers/{customer}',[CustomerController::class, 'show'])->name('customers.show');
Route::get('/bills/{bill}',[CustomerController::class, 'showBill'])->name('showbill.show');
Route::resource('items', ItemController::class);