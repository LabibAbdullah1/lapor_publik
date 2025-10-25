<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportPhotoController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\PasswordController;

// =====================================
// 🏠 PUBLIC ROUTES (tanpa login)
// =====================================
Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/reports', [ReportController::class, 'index']);
Route::get('/reports/{report}', [ReportController::class, 'show'])->name('reports.show');

//email verifikasi
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile', [PasswordController::class, 'update'])->name('password.update');
});



// =====================================
// 👤 USER ROUTES (hanya untuk warga terdaftar)
// =====================================
Route::middleware(['auth', 'verified'])->group(function () {

    // --- REPORT ---
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
    Route::get('/reports/my', [ReportController::class, 'myReports'])->name('reports.my'); // lihat laporan sendiri

    // --- COMMENT ---
    Route::post('/reports/{report}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // --- PHOTO UPLOAD ---
    Route::post('/reports/{report}/photos', [ReportPhotoController::class, 'store'])->name('photos.store');
    Route::delete('/photos/{id}', [ReportPhotoController::class, 'destroy'])->name('photos.destroy');
});

// =====================================
// 🧰 ADMIN ROUTES (khusus admin)
// =====================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    // --- DASHBOARD ---
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // --- REPORT MANAGEMENT ---
    Route::get('/reports', [ReportController::class, 'adminIndex'])->name('admin.reports.index');
    Route::get('/reports/{id}', [ReportController::class, 'adminShow'])->name('admin.reports.show');
    Route::patch('/reports/{id}/status', [ReportController::class, 'updateStatus'])->name('admin.reports.updateStatus');
    Route::delete('/reports/{id}', [ReportController::class, 'destroy'])->name('admin.reports.destroy');

    // --- USER MANAGEMENT ---
    Route::resource('/users', UserController::class);

    // --- COMMENT MANAGEMENT (optional) ---
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('admin.comments.destroy');
});
