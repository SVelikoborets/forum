<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [MainController::class,'index'])->name('main');
Route::get('/search', [MainController::class,'search'])->name('search');
Route::get('/user/{user}', [MainController::class, 'profile'])->name('profile');

Route::get('/load-topics/{categoryId}', [TopicController::class,'loadTopics']);

Route::get('/topics/{category}', [TopicController::class,'topics'])->name('topics');

Route::get('/posts/{topic?}', [PostController::class,'posts'])->name('posts');
Route::get('/post/{post?}', [PostController::class,'show'])->name('post.show');

Route::get('/comments/{post?}', [CommentController::class,'showComments'])->name('post.comments');

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'check.banned','verified']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/home/create/{step?}/{selected?}', [PostController::class,'create'])->name('post.create');
    Route::post('/home', [PostController::class,'store'])->name('post.store');

    Route::get('/topic/create/{category?}', [TopicController::class,'create'])->name('topic.create');
    Route::post('/topic', [TopicController::class,'store'])->name('topic.store');

    Route::get('/topic/edit/{topic}', [TopicController::class,'edit'])->name('topic.edit');
    Route::patch('/topic/{topic}',[TopicController::class,'update'])->name('topic.update');

    Route::get('/topic/{topic}/delete',[TopicController::class,'delete'])->name('topic.delete');
    Route::delete('/home/topic/{topic}',[TopicController::class,'destroy'])->name('topic.destroy');

    Route::get('/home/{post?}/edit',[PostController::class,'edit'])->name('post.edit');
    Route::patch('/home/{post}',[PostController::class,'update'])->name('post.update');

    Route::get('/home/{post}/delete',[PostController::class,'delete'])->name('post.delete');
    Route::delete('/home/{post}',[PostController::class,'destroy'])->name('post.destroy');

    Route::get('/response/{postId}/{user}', [CommentController::class,'response'])->name('response');
    Route::post('/comment/{postId}/{user?}', [CommentController::class,'addComment'])
        ->name('add.comment');
    Route::delete('/comment/{comment}',[CommentController::class,'destroy'])->name('comment.destroy');

    Route::post('/profile/avatar',[HomeController::class,'avatar'])
        ->name('profile.avatar');
    Route::get('/profile/{profile}/delete',[HomeController::class,'delete'])
        ->name('profile.delete');
    Route::delete('/profile/{profile}',[HomeController::class,'destroy'])
        ->name('profile.destroy');
    Route::patch('/block/user/{user}', [HomeController::class,'block'])->name('block');
});


