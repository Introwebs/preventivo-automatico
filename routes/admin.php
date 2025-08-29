<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WorkflowApiController;

/*
Route::middleware('auth', 'admin')->group(function () {

});
*/

Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/getservices', [AdminController::class, 'getServices'])->name('admin.getServices');

// Workflow
Route::middleware('wokflow.api')->group(function () {
    Route::get('/api/getservicedata', [WorkflowApiController::class, 'getServiceData'])->name('api.getServiceData');
});
