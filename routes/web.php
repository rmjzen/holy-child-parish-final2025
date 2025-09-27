<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\ManagePaymentController;
use App\Http\Controllers\DocumentRequestController;
use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\SacramentalServiceController;
use App\Http\Controllers\MarriageCertificateController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\BaptismalCertificateController;
use App\Http\Controllers\Admin\ServiceScheduleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Book service route
Route::get('/book-service', function () {
    return view('book_service');
})->middleware(['auth', 'verified'])->name('book-service');

// View Service Schedule route
Route::get('/view-service-schedule', function () {
    return view('service_schedule.index');
})->middleware(['auth', 'verified'])->name('view-service-schedule');

// Sacramental Service routes
Route::post('/sacramental-service/store', [SacramentalServiceController::class, 'store'])->name('sacramental-service.store');

Route::post('/marriage-request', [MarriageCertificateController::class, 'store'])
    ->name('marriage-request.store');

Route::post('/baptismal-request', [BaptismalCertificateController::class, 'store'])
    ->name('baptismal-request.store');

// For about us routes
Route::get('/about-us', function () {
    return view('about_us.index');
})->name('about-us');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
});

// for contact us routes
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

// payment routes
route::get('/checkout', [StripeController::class, 'index'])->name('checkout.index');
route::post('/checkout', [StripeController::class, 'checkout'])->name('checkout.process');

Route::get('/checkout/success', [StripeController::class, 'success'])->name('stripe.success');
Route::get('/checkout/cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');

// for admin routes

Route::get('/manage-service-schedule', [ServiceScheduleController::class, 'index'])->name('manage-service-schedule');
Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::get('/manage-payment', [ManagePaymentController::class, 'index'])->name('manage-payment');

Route::get('/send-notification', [AdminNotificationController::class, 'index'])->name('send.notification');

Route::get('/generate-report', [ReportController::class, 'index'])->name('generate-report');

require __DIR__.'/auth.php';
