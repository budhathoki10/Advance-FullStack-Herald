@extends('layouts.app')

@section('title', 'Create Student')

@section('content')
    <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="/students">Students</a>
        <span aria-hidden="true">/</span>
        <span>New</span>
    </nav>

    <div class="page-header">
        <div>
            <h1 class="page-header__title">Create Student</h1>
            <p class="page-header__subtitle">Add a new student to the institute.</p>
        </div>
    </div>

    @include('partials.errors')

    <form action="/students" method="POST" class="card" novalidate>
        @csrf

        <div class="card__body">
            @include('student._form')
        </div>

        <div class="card__footer">
            <a href="/students" class="btn btn--ghost">Cancel</a>
            <button type="submit" class="btn btn--primary">Create Student</button>
        </div>
    </form>
@endsection
