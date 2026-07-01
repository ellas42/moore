<?php
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\EventController;
//idk if its supposed to be in admin but it works
use App\Http\Controllers\Admin\BookingController; 

Route::get('/',        fn() => view('layouts.home'))->name('home');
Route::get('/events',  [EventController::class, 'index'])->name('events');
Route::get('/about',   fn() => view('about'))->name('about');
Route::get('/journal', fn() => view('journal'))->name('journal');

Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe');
Route::post('/booking',   [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/{booking}/confirmation',
    [BookingController::class, 'confirmation'])->name('booking.confirmation');



use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminSubscriberController;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::prefix('admin')->group(function () {
    Route::get('/',          [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/events',    [AdminEventController::class, 'index'])->name('admin.events');
    Route::get('/events/create', [AdminEventController::class, 'create'])->name('admin.events.create');
    Route::post('/events',   [AdminEventController::class, 'store'])->name('admin.events.store');
    Route::get('/events/{event}/edit', [AdminEventController::class, 'edit'])->name('admin.events.edit');
    Route::put('/events/{event}', [AdminEventController::class, 'update'])->name('admin.events.update');
    Route::delete('/events/{event}', [AdminEventController::class, 'destroy'])->name('admin.events.destroy');
    Route::patch('/events/{event}/toggle', [AdminEventController::class, 'toggle'])->name('admin.events.toggle');
    Route::get('/bookings',  [AdminBookingController::class, 'index'])->name('admin.bookings');
    Route::get('/subscribers', [AdminSubscriberController::class, 'index'])->name('admin.subscribers');
});

Route::post('/webhook/square', [WebhookController::class, 'handle']);

//email test delete soon
Route::get('/preview-email', function () {
    $subscriber = new \App\Models\Subscriber(['name' => 'Madison', 'email' => 'theuphoriass@gmail.com']);
    return new \App\Mail\SubscriberConfirmation($subscriber);
});

require __DIR__.'/auth.php';