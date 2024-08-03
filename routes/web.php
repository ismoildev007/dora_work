<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AgreementController;
use App\Http\Controllers\TransactionController;

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



Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard routes based on roles
Route::middleware('auth')->group(function () {
    Route::get('/manager', [AuthController::class, 'managerDashboard'])->name('manager.dashboard');
    Route::get('/admin', [AuthController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/staff', [AuthController::class, 'staffDashboard'])->name('staff.dashboard');
    Route::resource('users', UserController::class);
    Route::resource('activities', ActivityController::class);
    Route::delete('activity-images/{activityImage}', [ActivityController::class, 'destroyImage'])->name('activity-images.destroy');
    Route::delete('project-images/{project}', [ProjectController::class, 'destroyImage'])->name('project-images.destroy');
    Route::resource('clients', ClientController::class);
    Route::resource('managers', ManagerController::class);
    Route::resource('attendance', AttendanceController::class);
    Route::resource('messages', MessageController::class);
    Route::resource('reports', ReportController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('staffs', StaffController::class);

    // Yangi routlar

    Route::resource('agreements', AgreementController::class);
    Route::resource('transactions', TransactionController::class);
    Route::post('/transactions/{id}', [TransactionController::class, 'update'])->name('transactions.update');

    //---------------------------------------

    //Chat
    Route::get('/conversations', [ChatController::class, 'index']);
    Route::get('/broadcast', [ChatController::class, 'broadcast'])->name('broadcast');
    Route::post('/receive', [ChatController::class, 'receive'])->name('receive');

    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('notifications/read/{id}', [NotificationController::class, 'show'])->name('notifications.read');
    Route::get('notifications/clear', [NotificationController::class, 'clear'])->name('notifications.clear');
    Route::get('notifications/all', [NotificationController::class, 'all'])->name('notifications.all');
});
