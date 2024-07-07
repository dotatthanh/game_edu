<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthLoginController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('admin')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::resource('customers', CustomerController::class);
        Route::resource('users', UserController::class);
        Route::resource('news', NewsController::class);
        Route::resource('games', GameController::class);
        Route::get('/users/view-change-password/{user}', [UserController::class, 'viewChangePassword'])->name('users.view-change-password');
        Route::post('/users/change-password/{user}', [UserController::class, 'changePassword'])->name('users.change-password');
    });
    require __DIR__.'/auth.php';
});

Route::get('login', [AuthLoginController::class, 'login'])->name('web.login');
Route::post('login', [AuthLoginController::class, 'store'])->name('web.post-login');
Route::get('register', [AuthLoginController::class, 'register'])->name('web.register');
Route::post('register', [AuthLoginController::class, 'postRegister'])->name('web.post-register');

Route::post('logout-web', [AuthLoginController::class, 'destroy'])->name('web.logout');

Route::get('/', [IndexController::class, 'index'])->name('web.home');
Route::get('/tim-kiem', [IndexController::class, 'search'])->name('web.search');
Route::get('/tin-tuc', [IndexController::class, 'news'])->name('web.news');
Route::get('/tin-tuc/{news}', [IndexController::class, 'newsDetail'])->name('web.news-detail');
Route::get('/danh-muc', [IndexController::class, 'category'])->name('web.category');
Route::post('/thich-game/{id}', [IndexController::class, 'like'])->name('web.game-like');
Route::get('/yeu-thich', [IndexController::class, 'favorites'])->name('web.favorites');
Route::get('/thong-tin-tai-khoan', [IndexController::class, 'profile'])->name('web.profile');
Route::post('/luu-thong-tin-tai-khoan', [IndexController::class, 'saveProfile'])->name('web.save-profile');

// Auth::routes();
