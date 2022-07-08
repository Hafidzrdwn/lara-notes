<?php

use App\Http\Controllers\AuthController;
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
Route::get('/spaces', 'WorkspaceController@index')->name('spaces');
Route::get('/spaces/example/{space:slug}', 'WorkspaceController@show')->name('space.example');

Route::middleware(['guest'])->group(function () {
  Route::get('/auth/register', [AuthController::class, 'register'])->name('register');
  Route::post('/auth/register', [AuthController::class, 'registration'])->name('register.store');
  Route::get('/auth', [AuthController::class, 'index'])->name('login');
  Route::post('/auth', [AuthController::class, 'login'])->name('login.store');
});

Route::middleware(['check'])->group(function () {
  Route::get('/spaces/new', 'WorkspaceController@create')->name('space.create');
  Route::post('/spaces/new', 'WorkspaceController@store')->name('space.store');
  Route::get('/spaces/{space:slug}/edit', 'WorkspaceController@edit')->name('space.edit');
  Route::put('/spaces/{space:slug}', 'WorkspaceController@update')->name('space.update');
  Route::delete('/spaces/{space:slug}', 'WorkspaceController@destroy')->name('space.destroy');
  Route::get('/spaces/{space:slug}', 'WorkspaceController@show')->name('space');
  Route::get('/space/slug', 'WorkspaceController@makeSlug')->name('space.slug');
  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::view('/dashboard', 'dashboard.index')->name('dashboard');
