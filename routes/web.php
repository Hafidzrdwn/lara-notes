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
Route::get('/spaces/example/{space:slug}', 'WorkspaceController@show')->name('space.example');

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
      Route::get('/slug', 'makeSlug')->name('space.slug');
    });

    Route::get('{space:slug}/projects/new', 'ProjectController@create')->name('project.create');
    Route::post('{space:slug}/projects/new', 'ProjectController@store')->name('project.store');
    Route::get('{space:slug}/projects/{project:slug}', 'ProjectController@show')->name('project');
    Route::get('/{space:slug}/projects', 'ProjectController@edit')->name('project.edit');
    Route::put('{space:slug}/projects/{project:slug}', 'ProjectController@update')->name('project.update');
    Route::delete('{space:slug}/projects/{project:slug}', 'ProjectController@destroy')->name('project.destroy');

    Route::delete('{space:slug}/projects/{project:slug}/notes/{note}', 'NoteController@destroy')->name('note.destroy');
    Route::post('{space:slug}/projects/{project:slug}/notes/new', 'NoteController@store')->name('note.store');
    Route::put('{space:slug}/projects/{project:slug}/notes/{note}', 'NoteController@update')->name('note.update');
  });


  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::view('/dashboard', 'dashboard.index')->name('dashboard');
