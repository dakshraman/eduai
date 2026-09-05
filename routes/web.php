<?php

use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\FeeController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/login'));

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('students', StudentController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('classes', ClassController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('notices', NoticeController::class);
    Route::resource('events', EventController::class);
    Route::resource('exams', ExamController::class);

    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::get('/attendance/report', [AttendanceController::class, 'report'])->name('attendance.report');

    Route::get('/fees/categories', [FeeController::class, 'categories'])->name('fees.categories');
    Route::post('/fees/categories', [FeeController::class, 'storeCategory'])->name('fees.storeCategory');
    Route::get('/fees/structures', [FeeController::class, 'structures'])->name('fees.structures');
    Route::post('/fees/structures', [FeeController::class, 'storeStructure'])->name('fees.storeStructure');
    Route::get('/fees/payments', [FeeController::class, 'payments'])->name('fees.payments');
    Route::post('/fees/payments', [FeeController::class, 'recordPayment'])->name('fees.recordPayment');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
});
