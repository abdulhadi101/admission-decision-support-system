<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicantProfileController;
use App\Http\Controllers\AdmissionController;

//Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [ApplicantProfileController::class, 'show'])->name('applicant.profile');
    Route::put('/profile', [ApplicantProfileController::class, 'update'])->name('applicant.profile.update');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/calculate-scores', [AdmissionController::class, 'calculateScores'])->name('admission.calculate-scores');
    Route::get('/ranking/{course}', [AdmissionController::class, 'showRanking'])->name('admission.ranking');
    Route::get('/courses/{course}/requirements', [CourseRequirementController::class, 'index'])->name('course.requirements');
    Route::post('/courses/{course}/requirements', [CourseRequirementController::class, 'store'])->name('course.requirements.store');
    Route::put('/course-requirements/{requirement}', [CourseRequirementController::class, 'update'])->name('course.requirements.update');
    Route::delete('/course-requirements/{requirement}', [CourseRequirementController::class, 'destroy'])->name('course.requirements.destroy');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [ApplicantProfileController::class, 'show'])->name('applicant.profile');
    Route::put('/profile', [ApplicantProfileController::class, 'update'])->name('applicant.profile.update');
});
