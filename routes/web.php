<?php

use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\BillingController;
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
use App\Http\Controllers\Parent\ChildController as ParentChildController;
use App\Http\Controllers\Parent\DashboardController as ParentDashboardController;
use App\Http\Controllers\Student\AttendanceController as StudentAttendanceController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\ExamController as StudentExamController;
use App\Http\Controllers\Student\FeeController as StudentFeeController;
use App\Http\Controllers\Student\NoticeController as StudentNoticeController;
use App\Http\Controllers\SuperAdmin\DashboardController as SuperAdminDashboardController;
use App\Http\Controllers\SuperAdmin\PlanController as SuperAdminPlanController;
use App\Http\Controllers\SuperAdmin\SchoolController as SuperAdminSchoolController;
use App\Http\Controllers\Teacher\AttendanceController as TeacherAttendanceController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Teacher\ExamController as TeacherExamController;
use App\Http\Controllers\Teacher\NoticeController as TeacherNoticeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

/*
|--------------------------------------------------------------------------
| Shared (any authenticated role) — profile & logout
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

/*
|--------------------------------------------------------------------------
| Superadmin panel — platform-wide management
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:super_admin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/', [SuperAdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/schools', [SuperAdminSchoolController::class, 'index'])->name('schools.index');
    Route::get('/schools/{school}', [SuperAdminSchoolController::class, 'show'])->name('schools.show');
    Route::post('/schools/{school}/activate', [SuperAdminSchoolController::class, 'toggle'])->name('schools.toggle');
    Route::post('/schools/{school}/extend-trial', [SuperAdminSchoolController::class, 'extendTrial'])->name('schools.extendTrial');

    Route::get('/plans', [SuperAdminPlanController::class, 'index'])->name('plans.index');
    Route::post('/plans/{plan}/toggle', [SuperAdminPlanController::class, 'toggle'])->name('plans.toggle');
});

/*
|--------------------------------------------------------------------------
| Account Admin panel — school-level management (admin + accountant)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin,accountant'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    Route::get('/billing', [BillingController::class, 'index'])->name('billing.index');
    Route::post('/billing/subscribe', [BillingController::class, 'subscribe'])->name('billing.subscribe');
    Route::post('/billing/cancel', [BillingController::class, 'cancel'])->name('billing.cancel');
    Route::get('/billing/invoices', [BillingController::class, 'invoices'])->name('billing.invoices');

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

/*
|--------------------------------------------------------------------------
| Teacher panel — attendance marking, exam results, notices
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/', [TeacherDashboardController::class, 'index'])->name('dashboard');

    Route::get('/attendance', [TeacherAttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance', [TeacherAttendanceController::class, 'store'])->name('attendance.store');

    Route::get('/exams', [TeacherExamController::class, 'index'])->name('exams.index');
    Route::get('/exams/{exam}/results', [TeacherExamController::class, 'results'])->name('exams.results');
    Route::post('/exams/{exam}/results', [TeacherExamController::class, 'storeResults'])->name('exams.storeResults');

    Route::get('/notices', [TeacherNoticeController::class, 'index'])->name('notices.index');
});

/*
|--------------------------------------------------------------------------
| Student panel — my attendance, results, fees, notices
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/', [StudentDashboardController::class, 'index'])->name('dashboard');

    Route::get('/attendance', [StudentAttendanceController::class, 'index'])->name('attendance.index');

    Route::get('/results', [StudentExamController::class, 'results'])->name('results.index');

    Route::get('/fees', [StudentFeeController::class, 'index'])->name('fees.index');

    Route::get('/notices', [StudentNoticeController::class, 'index'])->name('notices.index');
});

/*
|--------------------------------------------------------------------------
| Parent panel — linked children overview
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:parent'])->prefix('parent')->name('parent.')->group(function () {
    Route::get('/', [ParentDashboardController::class, 'index'])->name('dashboard');

    Route::get('/children/{student}', [ParentChildController::class, 'show'])->name('children.show');
    Route::get('/children/{student}/attendance', [ParentChildController::class, 'attendance'])->name('children.attendance');
    Route::get('/children/{student}/results', [ParentChildController::class, 'results'])->name('children.results');
    Route::get('/children/{student}/fees', [ParentChildController::class, 'fees'])->name('children.fees');
});