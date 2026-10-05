<?php

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

Route::get('/', function () {
    return redirect('/students');
});

/*
|--------------------------------------------------------------------------
| Students
|--------------------------------------------------------------------------
*/

Route::get('/students', function () {
    $students = Student::latest()->get();

    return view('student.list', [
        'students' => $students,
    ]);
})->name('students.index');

Route::get('/students/create', function () {
    return view('student.create');
})->name('students.create');

Route::post('/students', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:students,email',
        'phone' => 'required|string|max:20',
        'address' => 'nullable|string|max:500',
        'date_of_birth' => 'nullable|date|before:today',
    ]);

    $student = Student::create($validated);

    return redirect()->route('students.index')
        ->with('success', "Student {$student->name} created successfully!");
})->name('students.store');

Route::get('/students/{id}', function ($id) {
    $student = Student::findOrFail($id);

    return view('student.detail', [
        'student' => $student,
    ]);
})->name('students.show');

Route::get('/students/{id}/edit', function ($id) {
    $student = Student::findOrFail($id);

    return view('student.edit', [
        'student' => $student,
    ]);
})->name('students.edit');

Route::put('/students/{id}', function (Request $request, $id) {
    $student = Student::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => [
            'required',
            'email',
            'max:255',
            Rule::unique('students')->ignore($student->id),
        ],
        'phone' => 'required|string|max:20',
        'address' => 'nullable|string|max:500',
        'date_of_birth' => 'nullable|date|before:today',
    ]);

    $student->update($validated);

    return redirect('/students/'.$student->id)
        ->with('success', 'Student updated successfully!');
})->name('students.update');

Route::delete('/students/{id}', function ($id) {
    $student = Student::findOrFail($id);

    $student->delete();

    return redirect('/students')
        ->with('success', "Student {$student->name} deleted successfully!");
})->name('students.destroy');

/*
|--------------------------------------------------------------------------
| Courses
|--------------------------------------------------------------------------
*/

$courseRules = [
    'name' => 'required|string|max:255',
    'description' => 'nullable|string|max:2000',
    'duration' => 'required|integer|min:1|max:520',
    'fee' => 'required|numeric|min:0|max:99999999.99',
    'difficulty' => ['required', Rule::in(Course::DIFFICULTIES)],
    'is_active' => 'boolean',
];

Route::get('/courses', function () {
    $courses = Course::latest()->get();

    return view('course.list', [
        'courses' => $courses,
    ]);
})->name('courses.index');

Route::get('/courses/create', function () {
    return view('course.create');
})->name('courses.create');

Route::post('/courses', function (Request $request) use ($courseRules) {
    $validated = $request->validate($courseRules);

    $course = Course::create($validated);

    return redirect()->route('courses.index')
        ->with('success', "Course {$course->name} created successfully!");
})->name('courses.store');

Route::get('/courses/{id}', function ($id) {
    $course = Course::findOrFail($id);

    return view('course.detail', [
        'course' => $course,
    ]);
})->name('courses.show');

Route::get('/courses/{id}/edit', function ($id) {
    $course = Course::findOrFail($id);

    return view('course.edit', [
        'course' => $course,
    ]);
})->name('courses.edit');

Route::put('/courses/{id}', function (Request $request, $id) use ($courseRules) {
    $course = Course::findOrFail($id);

    $validated = $request->validate($courseRules);

    $course->update($validated);

    return redirect('/courses/'.$course->id)
        ->with('success', 'Course updated successfully!');
})->name('courses.update');

Route::delete('/courses/{id}', function ($id) {
    $course = Course::findOrFail($id);

    $course->delete();

    return redirect('/courses')
        ->with('success', "Course {$course->name} deleted successfully!");
})->name('courses.destroy');
