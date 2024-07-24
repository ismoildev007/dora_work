<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resource('users', UserController::class);
Route::resource('activities', ActivityController::class);
Route::delete('activity-images/{activityImage}', [ActivityController::class, 'destroyImage'])->name('activity-images.destroy');
Route::resource('clients', ClientController::class);
Route::resource('managers', ManagerController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard routes based on roles
Route::middleware('auth')->group(function () {
    Route::get('/manager', [AuthController::class, 'managerDashboard'])->name('manager.dashboard');
    Route::get('/admin', [AuthController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/staff', [AuthController::class, 'staffDashboard'])->name('staff.dashboard');
});
