<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminTaskController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HealthEntryController;
use App\Http\Controllers\HealthTaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('tasks/{task}/complete', [HealthTaskController::class, 'complete'])->name('tasks.complete');
    Route::post('entry', [HealthEntryController::class, 'store'])->name('entry.store');
    Route::post('profile/goals', [DashboardController::class, 'updateGoals'])->name('profile.goals.update');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
        Route::post('users/{user}/role', [AdminUserController::class, 'updateRole'])->name('users.updateRole');
        Route::delete('users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

        Route::get('tasks', [AdminTaskController::class, 'index'])->name('tasks.index');
        Route::get('tasks/create', [AdminTaskController::class, 'create'])->name('tasks.create');
        Route::post('tasks', [AdminTaskController::class, 'store'])->name('tasks.store');
        Route::get('tasks/{task}/edit', [AdminTaskController::class, 'edit'])->name('tasks.edit');
        Route::put('tasks/{task}', [AdminTaskController::class, 'update'])->name('tasks.update');
        Route::delete('tasks/{task}', [AdminTaskController::class, 'destroy'])->name('tasks.destroy');
    });
});
