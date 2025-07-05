<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @include('partials.meta')
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    @include('layouts.header')
    @auth
        @if (auth()->id())
            <div class="d-flex flex-grow-1">
                @include('layouts.sidebar')

                <main class="flex-grow-1 p-4">
                    @yield('content')
                </main>
            </div>
        @endif
    @endauth

    @if (!auth()->id())
        <main class="py-4">
            @yield('content')
        </main>
    @endif

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
