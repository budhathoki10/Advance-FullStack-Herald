@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')
    <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="/students">Students</a>
        <span aria-hidden="true">/</span>
        <a href="/students/{{ $student->id }}">{{ $student->name }}</a>
        <span aria-hidden="true">/</span>
        <span>Edit</span>
    </nav>

    <div class="page-header">
        <div>
            <h1 class="page-header__title">Edit Student</h1>
            <p class="page-header__subtitle">Update {{ $student->name }}'s details.</p>
        </div>
    </div>

    @include('partials.errors')

    <form action="/students/{{ $student->id }}" method="POST" class="card" novalidate>
        @csrf
        @method('PUT')

        <div class="card__body">
            @include('student._form', ['student' => $student])
        </div>

        <div class="card__footer">
            <a href="/students/{{ $student->id }}" class="btn btn--ghost">Cancel</a>
            <button type="submit" class="btn btn--primary">Update Student</button>
        </div>
    </form>
@endsection
