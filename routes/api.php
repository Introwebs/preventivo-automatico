<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkflowApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/api/getservicedata', [WorkflowApiController::class, 'getServiceData'])->name('workflow.getServiceData')->middleware('wokflow.api');
Route::post('/api/retreivedata', [WorkflowApiController::class, 'retreiveData'])->name('workflow.retreiveData')->middleware('wokflow.api');
