<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CalendarController;
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
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Bookings
    Route::resource('bookings', BookingController::class);

    // Appointment
    Route::get('/appointment', function () {
        return view('book-service');
    })->name('book-service');

    // Sacramental Services
    Route::post('/sacramental-service/store', [SacramentalServiceController::class, 'store'])->name('sacramental-service.store');
    Route::post('/marriage-request', [MarriageCertificateController::class, 'store'])->name('marriage-request.store');
    Route::post('/baptismal-request', [BaptismalCertificateController::class, 'store'])->name('baptismal-request.store');

    // Service Schedule
    Route::get('/view-service-schedule', [CalendarController::class, 'index'])->name('view-service-schedule');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');

    // About Us
    Route::view('/about-us', 'about_us.index')->name('about-us');

    // Contact Us
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    // Payments
    Route::get('/checkout', [StripeController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [StripeController::class, 'checkout'])->name('checkout.process');
    Route::get('/checkout/success', [StripeController::class, 'success'])->name('stripe.success');
    Route::get('/checkout/cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');

    // Admin Routes
    Route::get('/manage-service-schedule', [ServiceScheduleController::class, 'index'])->name('service_schedule.index');
    Route::get('/service-schedule/{id}/edit', [ServiceScheduleController::class, 'edit'])->name('service_schedule.edit');
    Route::put('/service-schedule/{id}', [ServiceScheduleController::class, 'update'])->name('service_schedule.update');
    Route::delete('/service-schedule/{id}', [ServiceScheduleController::class, 'destroy'])->name('service_schedule.destroy');

    Route::get('/manage-payment', [ManagePaymentController::class, 'index'])->name('manage-payment');
    Route::get('/send-notification', [AdminNotificationController::class, 'index'])->name('send.notification');
    Route::get('/generate-report', [ReportController::class, 'index'])->name('generate-report');

    // My bookings routes
    // Sacramental service routes
    Route::get('/my-bookings', [BookingController::class, 'index'])->name('my_bookings');
    Route::get('/sacramental/my-bookings/{id}/edit', [BookingController::class, 'edit'])->name('sacramental.my_bookings.edit');
    Route::put('/sacramental/my-bookings/{id}', [BookingController::class, 'update'])->name('sacramental.my_bookings.update');




    Route::post('/sacramental/upload-payment/{id}', [\App\Http\Controllers\SacramentalServiceController::class, 'uploadPayment'])
        ->name('sacramental.uploadPayment');
});

require __DIR__ . '/auth.php';
