<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\WorkspaceController;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'home');
Route::get('/spaces', [WorkspaceController::class, 'index'])->name('spaces');
Route::get('/spaces/example/{space:slug}', [WorkspaceController::class, 'show'])->name('space.example');

Route::middleware(['guest'])->group(function () {
  Route::get('/auth/register', [AuthController::class, 'register'])->name('register');
  Route::post('/auth/register', [AuthController::class, 'registration'])->name('register.store');
  Route::get('/auth', [AuthController::class, 'index'])->name('login');
  Route::post('/auth', [AuthController::class, 'login'])->name('login.store');
});

Route::middleware(['check'])->group(function () {
  Route::get('/spaces/new', [WorkspaceController::class, 'create'])->name('spaces.create');
  Route::post('/spaces/new', [WorkspaceController::class, 'store'])->name('spaces.store');
  Route::get('/spaces/{space:slug}', [WorkspaceController::class, 'show'])->name('space');
  Route::get('/space/slug', [WorkspaceController::class, 'makeSlug'])->name('space.slug');
  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::view('/dashboard', 'dashboard.index')->name('dashboard');
