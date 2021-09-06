<?php

use App\Http\Controllers\AddNickController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SeedController;
use App\Http\Controllers\VerifyNickController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;


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
    Route::resource('/admin/package', PackageController::class)->except('show');
    Route::resource('/admin/server', ServerController::class)->except('show');
    Route::resource('/admin/question', QuestionController::class)->except('show');
    Route::resource('/admin/user', UserController::class)->except('show');
});

Route::get('/', [HomeController::class, 'index']);
Route::group(['middleware' => ['auth']], function () {
    Route::resource('/verify-nick', VerifyNickController::class)->only('index', 'update');
    Route::resource('/add-nick', AddNickController::class)->only('index', 'update');
});
Route::get('/package/{sanitized_name}', [PackageController::class, 'show']);

// Only for testing
Route::get('/seed', [SeedController::class, 'index']);
