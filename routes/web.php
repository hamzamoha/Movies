<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\Diff\Diff;

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

//Files
Route::get('/images/movies/{poster}', [FilesController::class, 'getPoster']);
Route::get('/backgrounds/{poster}', [FilesController::class, 'getBackground']);

//Auth
Route::get('/login', [UsersController::class, 'login'])->name('login');
Route::post('/login', [UsersController::class, 'postLogin']);
Route::get('/register', [UsersController::class, 'register'])->name('register');
Route::post('/register', [UsersController::class, 'store']);
Route::post('/logout', [UsersController::class, 'logout'])->name('logout');
Route::get('/settings', [UsersController::class, 'settings'])->name('auth.settings');
Route::get('/me/watch_later', [UsersController::class, 'watch_later'])->name('auth.watch_later');
Route::get('/me/favorites', [UsersController::class, 'favorites'])->name('auth.favorites');

//Admin
Route::get('/dashboard', [AdminsController::class, 'dashboard'])->name('dashboard');

//movies
Route::post('/movies/favorites/add', [UsersController::class, 'add_favorite']);
Route::post('/movies/watch_later/add', [UsersController::class, 'add_watch_later']);
Route::post('/movies/favorites/remove', [UsersController::class, 'remove_favorite']);
Route::post('/movies/watch_later/remove', [UsersController::class, 'remove_watch_later']);
Route::post('/movies/watch_later/watched', [UsersController::class, 'mark_as_watched']);
Route::post('/movies/watch_later/unwatched', [UsersController::class, 'mark_as_unwatched']);
Route::get('/movies/count', [MoviesController::class, 'count'])->name('movies.count');
Route::resource('movies', MoviesController::class);

//users
Route::get('/users/count', [UsersController::class, 'count'])->name('users.count');
Route::put('/users/me', [UsersController::class, 'update']);
Route::put('/users/me/password', [UsersController::class, 'update_password']);
Route::get('/getuser', function(){
    if(auth()->check()){
        $user = auth()->user();
        $user->created_at_str = $user->created_at->diffForHumans();
        $user->updated_at_str = $user->updated_at->diffForHumans();
        return $user;
    }
    return null;
});

//genres
Route::get('/genres', [MoviesController::class, 'genres'])->name('movies.genres');

Route::get('/', [PagesController::class, 'home'])->name('home');
