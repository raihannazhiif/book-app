<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Models\Borrow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Book Routes - Admin Only
Route::middleware(['auth', 'admin'])->name('book.')->prefix('/book')->group(function () {
    Route::get('/', [BookController::class,'index'])->name('index'); // book.index
    Route::get('/new', [BookController::class,'create'])->name('create'); // book.create-book
    Route::post('/new', [BookController::class,'store'])->name('store');

    //ROute show wxcluded from admin
    Route::get('/{slug}', [BookController::class,'show'])->name('show')->withoutMiddleware('admin');

    Route::get('/edit/{slug}', [BookController::class,'edit'])->name('edit');
    Route::post('/edit/{slug}', [BookController::class,'update'])->name('update');
    Route::delete('/delete/{id}', [BookController::class,'destroy'])->name('delete');
});

// Dashboard Routes
Route::middleware(['auth'])->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class,'index'])->name('index');
    Route::get('/borrow/{slug}', [DashboardController::class,'borrow'])->name('borrow');

    Route::middleware(['admin'])->get('/borrow-list', [DashboardController::class,'borrowList'])->name('borrow-list');
    Route::middleware(['admin'])->get('/borrow-list/{id}', [DashboardController::class,'showBorrow'])->name('show-borrow');
});

Route::middleware(['auth'])->name('borrow.')->group(function () {
    Route::post('/borrow/{id}', [BorrowController::class,'request'])->name('request');
    Route::middleware('admin')->patch('/borrow/accept', [BorrowController::class,'accept'])->name('accept');
    Route::middleware('admin')->patch('/borrow/decline/', [BorrowController::class,'decline'])->name('decline');
    Route::middleware('admin')->patch('/borrow/return', [BorrowController::class,'return'])->name('return');
    Route::middleware('admin')->patch('/borrow/lost', [BorrowController::class,'lost'])->name('lost');
});

// Auth Routes
Route::get('/sign-up', [UserController::class, 'signupForm'])->name('sign-up-form');
Route::post('/sign-up', [UserController::class,'register'])->name('register');
Route::get('/sign-in', [UserController::class,'signinForm'])->name('sign-in-form');
Route::post('/sign-in', [UserController::class,'login'])->name('login');
Route::post('/sign-out', [UserController::class,'logout'])->name('logout');