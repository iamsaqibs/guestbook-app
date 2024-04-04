<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestbookController;
use App\Http\Middleware\JsonContentType;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\GuestbookEntry;
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

/**
 * Routes for the guestbook API
 */

Route::get('/whoami', [AuthController::class, 'whoami']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/login', [AuthController::class, 'login'])->middleware(JsonContentType::class);

Route::group(['prefix' => '/guestbook', 'as' => 'guestbook.'], function () {
    Route::get('/', [GuestbookController::class, 'index']);
    Route::get('/my', [GuestbookController::class, 'getMyEntries'])->middleware('auth');
    Route::get('/{entry}', [GuestbookController::class, 'getEntry']);
    Route::delete('/{entry}', [GuestbookController::class, 'deleteEntry']);
    Route::post('/sign', [GuestbookController::class, 'sign'])->middleware(JsonContentType::class);
    Route::post('/update', [GuestbookController::class, 'updateEntry'])->middleware('auth');
});

