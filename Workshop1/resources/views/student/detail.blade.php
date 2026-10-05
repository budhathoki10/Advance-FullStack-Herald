@extends('layouts.app')

@section('title', $student->name)

@section('content')
    <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="/students">Students</a>
        <span aria-hidden="true">/</span>
        <span>{{ $student->name }}</span>
    </nav>

    <div class="page-header">
        <div>
            <h1 class="page-header__title">{{ $student->name }}</h1>
            <p class="page-header__subtitle">Student #{{ $student->id }}</p>
        </div>
        <div class="page-header__actions">
            <a href="/students" class="btn btn--secondary">Back to Students</a>
            <a href="/students/{{ $student->id }}/edit" class="btn btn--primary">Edit Student</a>
        </div>
    </div>

    <div class="card">
        <div class="card__body">
            <dl class="details">
                <div>
                    <dt>Email</dt>
                    <dd><a href="mailto:{{ $student->email }}">{{ $student->email }}</a></dd>
                </div>
                <div>
                    <dt>Phone</dt>
                    <dd><a href="tel:{{ $student->phone }}">{{ $student->phone }}</a></dd>
                </div>
                <div>
                    <dt>Date of birth</dt>
                    <dd>
                        @if($student->date_of_birth)
                            {{ $student->date_of_birth->format('j F Y') }}
                        @else
                            <span class="details__empty">Not provided</span>
                        @endif
                    </dd>
                </div>
                <div class="details__item--full">
                    <dt>Address</dt>
                    <dd>
                        @if($student->address)
                            {{ $student->address }}
                        @else
                            <span class="details__empty">Not provided</span>
                        @endif
                    </dd>
                </div>
            </dl>

            <p class="meta">
                Created {{ $student->created_at->format('j M Y, H:i') }}
                · Last updated {{ $student->updated_at->diffForHumans() }}
            </p>
        </div>
    </div>

    <div class="danger-zone">
        <div>
            <h2 class="danger-zone__title">Delete this student</h2>
            <p class="danger-zone__text">The record is removed permanently.</p>
        </div>
        <form
            action="/students/{{ $student->id }}"
            method="POST"
            data-confirm="Delete {{ $student->name }}? This cannot be undone."
        >
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn--danger">Delete Student</button>
        </form>
    </div>
@endsection
