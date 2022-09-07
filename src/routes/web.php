<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
| 認証
*/

Auth::routes();
// Route::get('/login/{provider}', 'App\Http\Controllers\Auth\LoginController@redirectToProvider')->name('login.{provider}');
// Route::get('/register/{provider}', 'App\Http\Controllers\Auth\RegisterController@showProviderUserRegistrationForm')->name('register.{provider}');
/*
|--------------------------------------------------------------------------
| Books Routes
|--------------------------------------------------------------------------
| 投稿
*/
Route::get('/', 'App\Http\Controllers\Books\IndexController')->name('book.index');
Route::prefix('books')->name('book.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::post('/', 'App\Http\Controllers\Books\StoreController')->name('store');
        Route::get('/create', 'App\Http\Controllers\Books\CreateController')->name('create');
        Route::delete('/{book}', 'App\Http\Controllers\Books\DestroyController')->name('destroy');
        Route::patch('/{book}', 'App\Http\Controllers\Books\UpdateController')->name('update');
        Route::get('/{book}/edit', 'App\Http\Controllers\Books\EditController')->name('edit');
        Route::put('/{book}/like', 'App\Http\Controllers\Books\LikeController')->name('like');
        Route::delete('/{book}/like', 'App\Http\Controllers\Books\UnlikeController')->name('unlike');

        // チャプター
        Route::get('/{book}/{episode}', 'App\Http\Controllers\Books\Episode\ShowController')->name('episode.show');
        Route::get('/{book}/{episode}/edit', 'App\Http\Controllers\Books\Episode\EditController')->name('episode.edit');
        Route::delete('/{book}', 'App\Http\Controllers\Books\Episode\DestroyController')->name('episode.destroy');
    });
    Route::get('/{book}', 'App\Http\Controllers\Books\ShowController')->name('show');
});

// タグ
Route::get('/tags/{name}', 'App\Http\Controllers\TagController')->name('tags.show');


/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
| ユーザー
*/
Route::middleware('auth')->group(function () {
    Route::patch('/{username}', 'App\Http\Controllers\User\UpdateController')->name('users.update');
    Route::put('/{username}/follow', 'App\Http\Controllers\User\FollowController')->name('users.follow');
    Route::delete('/{username}/follow', 'App\Http\Controllers\User\UnfollowController')->name('users.unfollow');
});
Route::get('/{username}', 'App\Http\Controllers\User\ShowController')->name('users.show');
Route::get('/{username}/likes', 'App\Http\Controllers\User\LikesController')->name('users.likes');
Route::get('/{username}/about', 'App\Http\Controllers\User\AboutController')->name('users.about');
Route::get('/{username}/followings', 'App\Http\Controllers\User\FollowingsController')->name('users.followings');
Route::get('/{username}/followers', 'App\Http\Controllers\User\FollowersController')->name('users.followers');
