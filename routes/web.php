<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
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

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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


    Route::name('admin.')->prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/monitor/{id}', [AdminController::class, 'monitor'])->name('monitor');

        Route::name('bank_soal.')->prefix('bank-soal')->group(function () {
            Route::get('/', [AdminController::class, 'bank_soal'])->name('index');
            Route::post('/', [AdminController::class, 'bankSoalAdd'])->name('store');
            Route::delete('/', [AdminController::class, 'bankSoalDelete'])->name('destroy');
            Route::put('/', [AdminController::class, 'bankSoalUpdate'])->name('update');

            Route::get('/{id}', function () {
                return Inertia::render('Admin/BankSoal/Detail');
            })->name('detail');
        });

        Route::name('jadwal_tes.')->prefix('jadwal-tes')->group(function () {
            Route::get('/', function () {
                return Inertia::render('Admin/Jadwal/Index');
            })->name('index');
            Route::get('/{id}', function () {
                return Inertia::render('Admin/Jadwal/Detail');
            })->name('detail');
        });

        Route::name('legalisir.')->prefix('legalisir')->group(function () {
            Route::get('/', function () {
                return Inertia::render('Admin/Legalisir/Index');
            })->name('index');
            Route::get('/{id}', function () {
                return Inertia::render('Admin/Legalisir/Detail');
            })->name('detail');
            Route::name('legalisir.')->prefix('legalisir')->group(function () {
                Route::get('/', function () {
                    return Inertia::render('Admin/Legalisir/Index');
                })->name('index');
                Route::get('/{id}', function () {
                    return Inertia::render('Admin/Legalisir/Detail');
                })->name('detail');
            });
        });
    });
});

require __DIR__ . '/auth.php';
