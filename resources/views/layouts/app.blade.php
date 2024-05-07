<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Registration')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('js/API_Ops.js') }}"></script>
    <script src="{{ asset('js/validation.js') }}"></script>


</head>
<body>
    <header>
        <h1>Welcome to FCAI Registration</h1>
        <nav>
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
        </nav>
    </header>

    <div id="error-summary" class="error-summary"></div>
    <div class="container">
        @yield('content')
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} User Registration. All rights reserved.</p>
    </footer>
</body>
</html>
