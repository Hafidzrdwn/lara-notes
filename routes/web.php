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
Route::get('/spaces', 'WorkspaceController@index')->name('spaces');

Route::middleware(['guest'])->group(function () {
  Route::controller(AuthController::class)->group(function () {
    Route::prefix('auth')->group(function () {
      Route::get('/register', 'register')->name('register');
      Route::post('/register', 'registration')->name('register.store');
      Route::get('/', 'index')->name('login');
      Route::post('/', 'login')->name('login.store');
    });
  });
});

Route::middleware(['check'])->group(function () {
  Route::prefix('spaces')->group(function () {
    Route::controller(WorkspaceController::class)->group(function () {
      Route::get('/new', 'create')->name('space.create');
      Route::post('/new', 'store')->name('space.store');
      Route::get('/{space:slug}/edit', 'edit')->name('space.edit');
      Route::put('/{space:slug}', 'update')->name('space.update');
      Route::delete('/{space:slug}', 'destroy')->name('space.destroy');
      Route::get('/{space:slug}', 'show')->name('space');
    });

    Route::get('{space:slug}/projects/new', 'ProjectController@create')->name('project.create');
    Route::post('{space:slug}/projects/new', 'ProjectController@store')->name('project.store');
    Route::get('{space:slug}/projects/{project:slug}', 'ProjectController@show')->name('project');
    Route::get('/{space:slug}/projects', 'ProjectController@edit')->name('project.edit');
    Route::put('{space:slug}/projects/{project:slug}', 'ProjectController@update')->name('project.update');
    Route::delete('{space:slug}/projects/{project:slug}', 'ProjectController@destroy')->name('project.destroy');

    Route::post('{space:slug}/projects/{project:slug}/notes/new', 'NoteController@store')->name('note.store');
    Route::put('{space:slug}/projects/{project:slug}/notes/{note}', 'NoteController@update')->name('note.update');
    Route::delete('{space:slug}/projects/{project:slug}/notes/{note}', 'NoteController@destroy')->name('note.destroy');
  });

  Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
  Route::get('/dashboard/space', 'DashboardController@space')->name('dashboard.space');
  Route::get('/dashboard/space/{space}', 'DashboardController@show')->name('dashboard.space.show');

  Route::get('/user/profile/{user:username}', 'UserController@index')->name('user.profile');
  Route::put('/user/profile/{user:username}', 'UserController@update')->name('user.update');
  Route::put('/user/profile/image', 'UserController@profile_update')->name('user.profile.update');
  Route::delete('/user/profile/image', 'UserController@delete_profile')->name('user.profile.destroy');

  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
