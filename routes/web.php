<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\SearchController;
use App\Mail\NewUserWelcomeMail;
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

Route::get('/page', [PagesController::class, 'main'])->name('page');
Route::get('/page/{user}', [PagesController::class, 'index'])->name('page.show');
Route::get('/search/', [SearchController::class, 'index'])->name('search');

Route::get('mail', function () {
    return new NewUserWelcomeMail();
});

Route::middleware('auth')->group(function () {
    Route::get('/', [PostsController::class, 'index'])->name('feed');
    Route::get('/duckie/{animal}', function(string $animal){
        if($animal !== 'duck' && $animal !== 'cat')
            abort(404);
        return view('duck', ['animal'=>$animal]);
    })->name('duckie');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/p/create', [PostsController::class, 'create'])->name('p.create');
    Route::post('/p', [PostsController::class, 'store'])->name('p.post');
    Route::delete('/p/{post}', [PostsController::class, 'destroy'])->name('p.destroy');
    Route::get('/page/{user}/edit', [PagesController::class, 'edit'])->name('page.edit');
    Route::patch('/page/{user}', [PagesController::class, 'update'])->name('page.update');
    Route::post('/follow/{user}', [FollowsController::class, 'store']);
    Route::post('/like/{post}', [LikesController::class, 'store']);
    Route::post('/like/comment/{comment}', [LikesController::class, 'likecomment']);
    Route::post('/like/reply/{reply}', [LikesController::class, 'likereply']);
    Route::post('/comment/{post}', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
    Route::patch('/comment/update/{comment}', [CommentController::class, 'update'])->name('comment.update');
    Route::post('/reply/{comment}', [ReplyController::class, 'store'])->name('reply.store');
    Route::delete('/reply/{reply}', [ReplyController::class, 'destroy'])->name('reply.destroy');
    Route::patch('/reply/update/{reply}', [ReplyController::class, 'update'])->name('reply.update');
});

Route::get('/p/{post}', [PostsController::class, 'show'])->name('p.show');
Route::get('/page/{user}/followers', [PagesController::class, 'followers']);
Route::get('/page/{user}/followings', [PagesController::class, 'followings']);

require __DIR__ . '/auth.php';

Route::get('/{username}', function ($username) {
    return redirect('/page/' . $username);
});
