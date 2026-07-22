<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillController;

// Route::get('/', function () {
//     return view('invoice');
// });

Route::get('/',[BillController::class, 'create']);
