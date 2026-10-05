@extends('layouts.app')

@section('title', $course->name)

@section('content')
    <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="/courses">Courses</a>
        <span aria-hidden="true">/</span>
        <span>{{ $course->name }}</span>
    </nav>

    <div class="page-header">
        <div>
            <h1 class="page-header__title">{{ $course->name }}</h1>
            <p class="page-header__subtitle">
                Course #{{ $course->id }} ·
                @if($course->is_active)
                    <span class="badge badge--dot badge--success">Active</span>
                @else
                    <span class="badge badge--dot badge--neutral">Inactive</span>
                @endif
            </p>
        </div>
        <div class="page-header__actions">
            <a href="/courses" class="btn btn--secondary">Back to Courses</a>
            <a href="/courses/{{ $course->id }}/edit" class="btn btn--primary">Edit Course</a>
        </div>
    </div>

    <div class="card">
        <div class="card__body">
            <dl class="details">
                <div>
                    <dt>Difficulty</dt>
                    <dd><span class="badge badge--{{ $course->difficulty }}">{{ ucfirst($course->difficulty) }}</span></dd>
                </div>
                <div>
                    <dt>Duration</dt>
                    <dd>{{ $course->duration }} {{ Str::plural('week', $course->duration) }}</dd>
                </div>
                <div>
                    <dt>Fee</dt>
                    <dd>NPR {{ number_format($course->fee, 2) }}</dd>
                </div>
                <div>
                    <dt>Status</dt>
                    <dd>{{ $course->is_active ? 'Currently offered' : 'Not currently offered' }}</dd>
                </div>
                <div class="details__item--full">
                    <dt>Description</dt>
                    <dd>
                        @if($course->description)
                            {!! nl2br(e($course->description)) !!}
                        @else
                            <span class="details__empty">No description provided</span>
                        @endif
                    </dd>
                </div>
            </dl>

            <p class="meta">
                Created {{ $course->created_at->format('j M Y, H:i') }}
                · Last updated {{ $course->updated_at->diffForHumans() }}
            </p>
        </div>
    </div>

    <div class="danger-zone">
        <div>
            <h2 class="danger-zone__title">Delete this course</h2>
            <p class="danger-zone__text">The record is removed permanently.</p>
        </div>
        <form
            action="/courses/{{ $course->id }}"
            method="POST"
            data-confirm="Delete {{ $course->name }}? This cannot be undone."
        >
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn--danger">Delete Course</button>
        </form>
    </div>
@endsection
