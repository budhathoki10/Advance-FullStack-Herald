@extends('layouts.app')

@section('title', 'Create Course')

@section('content')
    <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="/courses">Courses</a>
        <span aria-hidden="true">/</span>
        <span>New</span>
    </nav>

    <div class="page-header">
        <div>
            <h1 class="page-header__title">Create Course</h1>
            <p class="page-header__subtitle">Add a new course to the catalogue.</p>
        </div>
    </div>

    @include('partials.errors')

    <form action="/courses" method="POST" class="card" novalidate>
        @csrf

        <div class="card__body">
            @include('course._form')
        </div>

        <div class="card__footer">
            <a href="/courses" class="btn btn--ghost">Cancel</a>
            <button type="submit" class="btn btn--primary">Create Course</button>
        </div>
    </form>
@endsection
