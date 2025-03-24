<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthUser;
use Illuminate\Support\Facades\Route;

//user who have logged in yet
// Route::get('/', function () {
//     return view('index');
// });
Route::get('/', [IndexController::class, 'index'])->name('home');

Route::prefix('auth')->group(function () {
    //user register page
    Route::get('/register', [UserController::class, 'showRegister'])->name('user.register');
    Route::post('/register', [UserController::class, 'createUser'])->name('createUser');

    //user login page
    Route::get('/login', [UserController::class, 'showLogin'])->name('user.login');
    Route::post('/login', [UserController::class, 'login']);


    //logout
    Route::get('logout', [UserController::class, 'logout'])->name('user.logout');
});

Route::middleware([AuthUser::class])->group(function () {
    Route::prefix('user')->group(function () {
        //user index page
        Route::get('/', [IndexController::class, 'userIndex'])->name('user.home');
    });
});
