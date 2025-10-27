<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/courses/store', [CourseController::class, 'store'])->name('courses.store');
Route::get('/courses/show', [CourseController::class, 'index'])->name('show');
