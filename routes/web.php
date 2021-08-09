<?php

use App\Http\Controllers\ConversationController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {

    Route::post('messages', [MessageController::class, 'store'])->name('mes_store');

    Route::get('conversations', [ConversationController::class, 'index'])->name('con_index');
    Route::post('conversations', [ConversationController::class, 'store'])->name('con_store');
    Route::get('conversations/{receiver}', [ConversationController::class, 'show'])->name('con_show');
});
