<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\KohaController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\DeptprogController;


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
    Route::get('/admin/dept_prog/dept_management',[DeptprogController::class,'view_dept_management'])->name('admin.dept_management');
    Route::post('/departments', [DeptprogController::class, 'store'])->name('departments.store');
    Route::get('/admin/facility/fac_management',[FacilityController::class,'view_fac_management'])->name('admin.fac_management');
    Route::post('/facilities', [FacilityController::class, 'storeFacility'])->name('facilities.storeFacility');
    Route::put('/facilities/{facility}', [FacilityController::class, 'updateFacility'])->name('facilities.updateFacility');
    Route::delete('/facilities/{facility}', [FacilityController::class, 'destroyFacility'])->name('facilities.destroyFacility');
    Route::get('/admin/student/std_management',[StudentController::class,'view_std_management'])->name('admin.std_management');
    Route::post('/students/import', [StudentController::class, 'import'])->name('students.import');
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

Route::middleware(['auth', 'role:librarian'])->group(function() {
        Route::get('/librarian/search-dues',[KohaController::class,'showSearchPage'])->name('librarian.search-dues');
        Route::post('/librarian/search-dues', [KohaController::class, 'searchDues'])->name('librarian.search.dues.submit');
});



