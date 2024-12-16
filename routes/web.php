<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\KohaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Admin Routes

Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/admin/dashboard',[HomeController::class,'adminDashboard'])->name('admin.dashboard');
});

// Student Routes
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/nodue_apply', [StudentController::class, 'viewStdDashboard'])->name('student.nodue_apply');
});

// SSO Routes
Route::middleware(['auth', 'role:sso'])->group(function () {
    Route::get('/sso/dashboard', [SSOController::class, 'index'])->name('sso.dashboard');
});

// Concerned Person Routes
Route::middleware(['auth', 'role:concerned_person'])->group(function () {
    Route::get('/concerned-person/dashboard', [ConcernedPersonController::class, 'index'])->name('concerned_person.dashboard');
});

Route::get('/student-dues/{studentId}/', [KohaController::class, 'getStudentDues'])->name('admin.dues');



Route::get('/librarian/search-dues', [KohaController::class, 'showSearchPage'])->name('librarian.search.dues');
Route::post('/librarian/search-dues', [KohaController::class, 'searchDues'])->name('librarian.search.dues.submit');
