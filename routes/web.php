<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('students', StudentController::class);
Route::post('students/{student}/enroll', [StudentController::class, 'enroll'])->name('students.enroll');
Route::delete('students/{student}/courses/{course}', [StudentController::class, 'unenroll'])->name('students.unenroll');

Route::resource('courses', CourseController::class);

Route::get('activities', [ActivityController::class, 'index'])->name('activities.index');
Route::get('activities/create', [ActivityController::class, 'create'])->name('activities.create');
Route::post('activities', [ActivityController::class, 'store'])->name('activities.store');
Route::get('activities/{activity}', [ActivityController::class, 'show'])->name('activities.show');
Route::post('activities/{activity}/submit', [ActivityController::class, 'submit'])->name('activities.submit');
Route::delete('activities/{activity}', [ActivityController::class, 'destroy'])->name('activities.destroy');
