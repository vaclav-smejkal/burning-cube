<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AddNicknameController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HowToDoItController;
use App\Http\Controllers\NotifyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SeedController;
use App\Http\Controllers\VerifyNicknameController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PageTextsController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VOPController;

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
    Route::resource('/admin/package', PackageController::class)->except('show', 'create');
    Route::resource('/admin/server', ServerController::class)->except('show', 'create');
    Route::resource('/admin/question', QuestionController::class)->except('show', 'create');
    Route::resource('/admin/user', UserController::class)->except('show', 'create');
    Route::resource('/admin/page-texts', PageTextsController::class)->except('show', 'create', 'destroy', 'store');
});

Route::resource('/order', OrderController::class)->except('create', 'destroy');
Route::get('/notify', [NotifyController::class, 'index']);

Route::get('/', [HomeController::class, 'index']);
Route::get('/vop', [VOPController::class, 'index']);
Route::get('/kontakt', [ContactController::class, 'index']);
Route::get('/o-nas', [AboutController::class, 'index']);
Route::get('/how-to-do-it', [HowToDoItController::class, 'index']);
Route::group(['middleware' => ['auth']], function () {
    Route::resource('/verify-nickname', VerifyNicknameController::class)->only('index', 'update');
    Route::resource('/add-nickname', AddNicknameController::class)->only('index', 'update');
});
Route::get('/package/{sanitized_name}', [PackageController::class, 'show']);

// Only for testing
Route::get('/seed', [SeedController::class, 'index']);
