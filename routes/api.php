<?php

use App\Http\Controllers\Position;
use App\Http\Controllers\Employee;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('position')->group(function () {
    Route::get('/', [Position::class, 'index']);
    Route::get('/{id}', [Position::class, 'show']);
    Route::post('/', [Position::class, 'store']);
    Route::put('/{id}', [Position::class, 'update']);
    Route::delete('/{id}', [Position::class, 'destroy']);
});

Route::prefix('employee')->group(function () {
    Route::get('/', [Employee::class, 'index']);
    Route::get('/{id}', [Employee::class, 'show']);
    Route::post('/', [Employee::class, 'store']);
    Route::put('/{id}', [Employee::class, 'update']);
    Route::delete('/{id}', [Employee::class, 'destroy']);
});
