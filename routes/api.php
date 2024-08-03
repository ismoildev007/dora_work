<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;


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
//Route::get('/conversations/{conversation}/messages', [ChatController::class, 'fetchMessages']);
//Route::get('/chat/{conversation}', [ChatController::class, 'index'])->name('chat.index');
//Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');

Route::get('reports', [\App\Http\Controllers\ApiController::class, 'report']);
Route::get('reports/{department}', [\App\Http\Controllers\ApiController::class, 'department']);
