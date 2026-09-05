<?php

use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\FeeController;
use App\Http\Controllers\Admin\LibraryController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\ParentController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\TransportController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('home'))->name('home');

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
    Route::get('/fees/receipt/{payment}', [FeeController::class, 'receipt'])->name('fees.receipt');

    Route::get('/exams/{exam}/results', [ExamController::class, 'results'])->name('exams.results');
    Route::post('/exams/{exam}/results', [ExamController::class, 'storeResults'])->name('exams.storeResults');
    Route::get('/students/{student}/results', [ExamController::class, 'studentResults'])->name('exams.studentResults');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    Route::get('/library', [LibraryController::class, 'index'])->name('library.index');
    Route::post('/library/books', [LibraryController::class, 'storeBook'])->name('library.storeBook');
    Route::delete('/library/books/{book}', [LibraryController::class, 'destroyBook'])->name('library.destroyBook');
    Route::post('/library/issue', [LibraryController::class, 'issueBook'])->name('library.issueBook');
    Route::post('/library/return/{bookIssue}', [LibraryController::class, 'returnBook'])->name('library.returnBook');
    Route::get('/library/issues', [LibraryController::class, 'issues'])->name('library.issues');

    Route::resource('parents', ParentController::class);

    Route::get('/academic-years', [AcademicYearController::class, 'index'])->name('academic-years.index');
    Route::post('/academic-years', [AcademicYearController::class, 'store'])->name('academic-years.store');
    Route::post('/academic-years/{academicYear}/activate', [AcademicYearController::class, 'activate'])->name('academic-years.activate');
    Route::delete('/academic-years/{academicYear}', [AcademicYearController::class, 'destroy'])->name('academic-years.destroy');

    Route::get('/transport', [TransportController::class, 'index'])->name('transport.index');
    Route::post('/transport/routes', [TransportController::class, 'storeRoute'])->name('transport.storeRoute');
    Route::delete('/transport/routes/{transportRoute}', [TransportController::class, 'destroyRoute'])->name('transport.destroyRoute');
    Route::post('/transport/vehicles', [TransportController::class, 'storeVehicle'])->name('transport.storeVehicle');
    Route::delete('/transport/vehicles/{vehicle}', [TransportController::class, 'destroyVehicle'])->name('transport.destroyVehicle');
});
