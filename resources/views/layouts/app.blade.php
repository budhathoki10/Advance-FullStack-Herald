<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') · Training Institute</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <a href="#main" class="skip-link">Skip to content</a>

    <header class="topbar">
        <div class="container topbar__inner">
            <a href="/students" class="brand">
                <span class="brand__mark" aria-hidden="true">TI</span>
                <span>Training Institute</span>
            </a>

            <nav class="nav" aria-label="Primary">
                <a href="/students" class="nav__link" @if(request()->is('students*')) aria-current="page" @endif>Students</a>
                <a href="/courses" class="nav__link" @if(request()->is('courses*')) aria-current="page" @endif>Courses</a>
            </nav>
        </div>
    </header>

    <main id="main" class="container main">
        @if(session('success'))
            <div class="alert alert--success" role="status">
                <svg class="alert__icon" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @yield('content')
    </main>

    <script>
        // Ask before destructive actions, and show a loading state while a form submits.
        document.addEventListener('submit', function (event) {
            const form = event.target;

            if (form.dataset.confirm && !window.confirm(form.dataset.confirm)) {
                event.preventDefault();
                return;
            }

            const button = event.submitter || form.querySelector('[type="submit"]');
            if (button) {
                button.classList.add('is-loading');
                button.setAttribute('aria-disabled', 'true');
            }
        });

        // Reset buttons when the page is restored from the back/forward cache.
        window.addEventListener('pageshow', function () {
            document.querySelectorAll('.is-loading').forEach(function (button) {
                button.classList.remove('is-loading');
                button.removeAttribute('aria-disabled');
            });
        });
    </script>
</body>
</html>
