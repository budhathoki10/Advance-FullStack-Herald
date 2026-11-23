<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\StudentController;
use Illuminate\Support\Facades\Route;

// Named with an "api." prefix so they don't collide with the web routes
// (students.index, courses.index, ...) used by the Blade views.
Route::apiResource('students', StudentController::class)->names('api.students');
Route::apiResource('courses', CourseController::class)->names('api.courses');

/*
this actually means that the api.php file is used to define the routes for the API endpoints of the application. The routes are defined using the Route facade provided by Laravel, and they map HTTP requests to specific controller actions.
Route::get('students', [StudentController::class, 'index']);
Route::post('students', [StudentController::class, 'store']);
Route::get('students/{student}', [StudentController::class, 'show']);
Route::put('students/{student}', [StudentController::class, 'update']);
Route::delete('students/{student}', [StudentController::class, 'destroy']);
*/

