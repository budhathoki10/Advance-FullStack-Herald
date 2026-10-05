@extends('layouts.app')

@section('title', 'Students')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-header__title">Students</h1>
            <p class="page-header__subtitle">
                {{ $students->count() }} {{ Str::plural('student', $students->count()) }} enrolled
            </p>
        </div>
        <div class="page-header__actions">
            <a href="/students/create" class="btn btn--primary">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z"/></svg>
                Create Student
            </a>
        </div>
    </div>

    <div class="card">
        @if($students->isEmpty())
            <div class="empty">
                <div class="empty__icon" aria-hidden="true">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z"/></svg>
                </div>
                <h2 class="empty__title">No students found</h2>
                <p class="empty__text">Get started by adding the first student.</p>
                <a href="/students/create" class="btn btn--primary">Create Student</a>
            </div>
        @else
            <div class="table-wrap">
                <table class="table table--stack">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td data-label="ID" class="table__muted">#{{ $student->id }}</td>
                                <td data-label="Name">
                                    <a href="/students/{{ $student->id }}" class="table__primary">{{ $student->name }}</a>
                                </td>
                                <td data-label="Email" class="table__muted">{{ $student->email }}</td>
                                <td data-label="Phone" class="table__muted">{{ $student->phone }}</td>
                                <td class="table__actions">
                                    <a href="/students/{{ $student->id }}" class="btn btn--ghost btn--sm">View</a>
                                    <a href="/students/{{ $student->id }}/edit" class="btn btn--ghost btn--sm">Edit</a>
                                    <form
                                        action="/students/{{ $student->id }}"
                                        method="POST"
                                        data-confirm="Delete {{ $student->name }}? This cannot be undone."
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
