<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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


Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->name('index');

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->middleware('verified')->name('dashboard');

    Route::name('profile.')->prefix('/profile')->group(function () {
        Route::get('', [ProfileController::class, 'index'])->name('index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::get('/password', [ProfileController::class, 'password'])->name('password');
        Route::patch('', [ProfileController::class, 'update'])->name('update');
        Route::delete('', [ProfileController::class, 'destroy'])->name('destroy');
    });

    Route::name('exam.')->group(function () {
        Route::get('/exam/{id}', [ExamController::class, 'show'])->name('detail');
        Route::get('/exam/{id}/pembayaran', [ExamController::class, 'payment'])->name('payment');
        Route::get('/history', [ExamController::class, 'history'])->name('history');
        Route::get('/history/{id}', [ExamController::class, 'detail_history'])->name('history.detail');
    });

});

Route::name('admin.')->prefix('admin')->group(function() {
    Route::get('/', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('index');

    Route::get('/monitor/{id}', function () {
        return Inertia::render('Admin/MonitorUjian');
    })->name('monitor');
});

require __DIR__ . '/auth.php';
