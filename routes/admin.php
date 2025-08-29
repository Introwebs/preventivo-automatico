<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
Route::middleware('auth', 'admin')->group(function () {

});
*/

Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/getservices', [AdminController::class, 'getServices'])->name('admin.getServices');
