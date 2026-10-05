@extends('layouts.app')

@section('title', 'Courses')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-header__title">Courses</h1>
            <p class="page-header__subtitle">
                {{ $courses->count() }} {{ Str::plural('course', $courses->count()) }}
                · {{ $courses->where('is_active', true)->count() }} currently offered
            </p>
        </div>
        <div class="page-header__actions">
            <a href="/courses/create" class="btn btn--primary">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z"/></svg>
                Create Course
            </a>
        </div>
    </div>

    <div class="card">
        @if($courses->isEmpty())
            <div class="empty">
                <div class="empty__icon" aria-hidden="true">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path d="M10.75 16.82A7.462 7.462 0 0115 15.5c.71 0 1.396.098 2.046.282A.75.75 0 0018 15.06v-11a.75.75 0 00-.546-.721A9.006 9.006 0 0015 3a8.963 8.963 0 00-4.25 1.065V16.82zM9.25 4.065A8.963 8.963 0 005 3c-.85 0-1.673.118-2.454.339A.75.75 0 002 4.06v11a.75.75 0 00.954.721A7.506 7.506 0 015 15.5c1.579 0 3.042.487 4.25 1.32V4.065z"/></svg>
                </div>
                <h2 class="empty__title">No courses found</h2>
                <p class="empty__text">Create the first course to start building the catalogue.</p>
                <a href="/courses/create" class="btn btn--primary">Create Course</a>
            </div>
        @else
            <div class="table-wrap">
                <table class="table table--stack">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Difficulty</th>
                            <th scope="col" class="table__num">Duration</th>
                            <th scope="col" class="table__num">Fee</th>
                            <th scope="col">Status</th>
                            <th scope="col"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <td data-label="ID" class="table__muted">#{{ $course->id }}</td>
                                <td data-label="Name">
                                    <a href="/courses/{{ $course->id }}" class="table__primary">{{ $course->name }}</a>
                                </td>
                                <td data-label="Difficulty">
                                    <span class="badge badge--{{ $course->difficulty }}">{{ ucfirst($course->difficulty) }}</span>
                                </td>
                                <td data-label="Duration" class="table__num table__muted">
                                    {{ $course->duration }} {{ Str::plural('week', $course->duration) }}
                                </td>
                                <td data-label="Fee" class="table__num">NPR {{ number_format($course->fee, 2) }}</td>
                                <td data-label="Status">
                                    @if($course->is_active)
                                        <span class="badge badge--dot badge--success">Active</span>
                                    @else
                                        <span class="badge badge--dot badge--neutral">Inactive</span>
                                    @endif
                                </td>
                                <td class="table__actions">
                                    <a href="/courses/{{ $course->id }}" class="btn btn--ghost btn--sm">View</a>
                                    <a href="/courses/{{ $course->id }}/edit" class="btn btn--ghost btn--sm">Edit</a>
                                    <form
                                        action="/courses/{{ $course->id }}"
                                        method="POST"
                                        data-confirm="Delete {{ $course->name }}? This cannot be undone."
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn--danger-ghost btn--sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
