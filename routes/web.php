<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BookingController;

Route::get('/',        fn() => view('home'))->name('home');
Route::get('/about',   fn() => view('about'))->name('about');
Route::get('/events',  [EventController::class, 'index'])->name('events');
Route::get('/journal', fn() => view('journal'))->name('journal');

Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe');
Route::post('/booking',   [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/{booking}/confirmation',
    [BookingController::class, 'confirmation'])->name('booking.confirmation');