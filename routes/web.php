<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SeedController;
use App\Http\Controllers\VerifyNickController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PackageController;

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

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/admin', function () {
        return redirect('/admin/dashboard');
    });
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/verify-nick', [VerifyNickController::class, 'index']);
Route::get('/package/{sanitized_name}', [PackageController::class, 'show']);

// Only for testing
Route::get('/seed', [SeedController::class, 'index']);
