<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\User\BookController as UserBookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\User\AboutController;
use App\Http\Controllers\Web\IndexController;
use App\Http\Controllers\User\GroupController;
use App\Http\Controllers\User\EventController;

Route::controller(IndexController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/detail/{id}', 'detail')->name('detail');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(BookController::class)->group(function () {
        Route::get('/books', 'index')->name('books.index');
        Route::get('/books/create', 'create')->name('books.create');
        Route::post('/books/store', 'store')->name('books.store');
        Route::get('/books/{id}/edit', 'edit')->name('books.edit');
        Route::post('/books/{id}/update', 'update')->name('books.update');
        Route::post('/books/delete', 'destroy')->name('books.delete');
    });

    Route::prefix('user')->group(function () {
        Route::controller(UserBookController::class)->group(function () {
            Route::get('/books', 'index')->name('user.books');
            Route::get('/books/{id}/detail', 'show')->name('user.books.detail');
            Route::post('/books/{id}/rating-store', 'rating_store')->name('user.books.rating-store');
        });

        Route::controller(UserController::class)->group(function () {
            Route::get('/user-creation', 'index')->name('user.user-creation.index');
            Route::get('/user-creation/create', 'create')->name('user.user-creation.create');
            Route::post('/user-creation/store', 'store')->name('user.user-creation.store');
            Route::get('/user-creation/{id}/edit', 'edit')->name('user.user-creation.edit');
            Route::post('/user-creation/{id}/update', 'update')->name('user.user-creation.update');
            Route::post('/user-creation/delete', 'delete')->name('user.user-creation.delete');
        });

        Route::controller(ReviewController::class)->group(function () {
            Route::get('/reviews', 'index')->name('user.reviews.index');
            Route::post('/reviews/delete', 'delete')->name('user.reviews.delete');
        });

        Route::controller(GroupController::class)->group(function () {
            Route::get('/groups', 'index')->name('user.groups.index');
            Route::get('/groups/create', 'create')->name('user.groups.create');
            Route::post('/groups/store', 'store')->name('user.groups.store');
            Route::get('/groups/{id}/edit', 'edit')->name('user.groups.edit');
            Route::post('/groups/{id}/update', 'update')->name('user.groups.update');
            Route::post('/groups/delete', 'delete')->name('user.groups.delete');

            Route::get('/groups/view-all/{status}', 'view_all')->name('user.groups.view-all');
            Route::get('/groups/request/{id}/store', 'request_store')->name('user.groups.joined-request');
            Route::get('/groups/{id}/members', 'group_members')->name('user.groups.members');
            Route::post('/groups/update-joined-user-status', 'group_status_update')->name('user.groups.status.update');
        });

        Route::controller(EventController::class)->group(function () {
            Route::get('/groups/{id}/events', 'index')->name('user.groups.events');
            Route::get('/groups/{id}/events/create', 'create')->name('user.groups.events.create');
            Route::post('/groups/{id}/events/store', 'store')->name('user.groups.events.store');
            Route::get('/groups/{id}/events/{event_id}/edit', 'edit')->name('user.groups.events.edit');
            Route::post('/groups/{id}/events/{event_id}/update', 'update')->name('user.groups.events.update');
            Route::post('/groups/{id}/events/{event_id}/delete', 'destroy')->name('user.groups.events.delete');
            Route::get('/groups/{id}/events/{event_id}/detail', 'detail')->name('user.groups.events.detail');
            Route::post('events/{event_id}/store', 'eventcomment_store')->name('user.groups.events.eventcomment_store');
            Route::post('events/comment-reply', 'eventcomment_reply_store')->name('user.groups.events.eventcomment_reply_store');
        });
        Route::controller(AboutController::class)->group(function () {
            Route::get('/about', 'index')->name('user.about.index');
        });
    });
});



require __DIR__ . '/auth.php';
