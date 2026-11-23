<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StoreStudentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller
// buildin laravel controller 
{
    /**
     * Display a listing of students.
     */
    public function index()
    {
        // fetch every row from table 
        $students = Student::all();

        return StudentResource::collection($students);
        // means display excatly how the StudentResource defined 
    }

    /**
     * Store a newly created student.
     */
    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->validated());

        return (new StudentResource($student))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student)
    {
        return new StudentResource($student);
    }

    /**
     * Update the specified student.
     */
    public function update(
        UpdateStudentRequest $request,
        Student $student
    ) {
        $student->update($request->validated());

        return new StudentResource($student->fresh());
        // fresh means return the updated data from database
    }

    /**
     * Remove the specified student.
     */
    public function destroy(Student $student): JsonResponse
    {
        $student->delete();

        return response()->json(null, 204);
    }
}
