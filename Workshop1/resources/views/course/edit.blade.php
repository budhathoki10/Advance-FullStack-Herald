@extends('layouts.app')

@section('title', 'Edit Course')

@section('content')
    <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="/courses">Courses</a>
        <span aria-hidden="true">/</span>
        <a href="/courses/{{ $course->id }}">{{ $course->name }}</a>
        <span aria-hidden="true">/</span>
        <span>Edit</span>
    </nav>

    <div class="page-header">
        <div>
            <h1 class="page-header__title">Edit Course</h1>
            <p class="page-header__subtitle">Update the details of {{ $course->name }}.</p>
        </div>
    </div>

    @include('partials.errors')

    <form action="/courses/{{ $course->id }}" method="POST" class="card" novalidate>
        @csrf
        @method('PUT')

        <div class="card__body">
            @include('course._form', ['course' => $course])
        </div>

        <div class="card__footer">
            <a href="/courses/{{ $course->id }}" class="btn btn--ghost">Cancel</a>
            <button type="submit" class="btn btn--primary">Update Course</button>
        </div>
    </form>
@endsection
