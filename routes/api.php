<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemRestoreController;
use App\Http\Controllers\ItemTrashController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\StoreRestoreController;
use App\Http\Controllers\StoreTrashController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('store')->group(function () {
    Route::apiResource('/', StoreController::class)
        ->parameters(['' => 'name'])
        ->scoped(['name' => 'string'])
        ->except('store');
    Route::post('/{name:string}', [StoreController::class, 'store']);
    Route::put('/{name:string}/trash', StoreTrashController::class);
    Route::put('/{name:string}/restore', StoreRestoreController::class);
});


Route::prefix('item')->group(function () {
    Route::apiResource('/', ItemController::class)
        ->parameters(['' => 'name'])
        ->scoped(['name' => 'string'])
        ->except('store');
    Route::put('/{name:string}/trash', ItemTrashController::class);
    Route::put('/{name:string}/restore', ItemRestoreController::class);
    Route::post('/{name:string}', [ItemController::class, 'store']);
});
