<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\GameController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/profile/update', [UserController::class, 'update'])->name('user.update');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications', [NotificationController::class, 'store'])->name('notifications.store');
    Route::patch('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
 
    Route::get('teams', [TeamController::class, 'index'])->name('teams.index');
    Route::get('teams/create', [TeamController::class, 'create'])->name('teams.create');
    Route::post('teams', [TeamController::class, 'store'])->name('teams.store');
    Route::get('teams/{team}/edit', [TeamController::class, 'edit'])->name('teams.edit');
    Route::put('teams/{team}', [TeamController::class, 'update'])->name('teams.update');
    Route::delete('teams/{team}', [TeamController::class, 'destroy'])->name('teams.destroy');
    Route::resource('players', PlayerController::class);
    Route::resource('goals', GoalController::class);
    Route::resource('games', GameController::class);
    Route::resource('cards', CardController::class);
});
Route::patch('/games/{game}/finish', [GameController::class, 'finish'])->name('games.finish');

