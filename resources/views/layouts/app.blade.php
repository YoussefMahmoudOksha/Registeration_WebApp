<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Registration')</title>
     <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/API_Ops.js') }}"></script>                      {{-- if you don't have npm use this 3 lines --}}
    <script src="{{ asset('js/validation.js') }}"></script> 
    

   {{-- @vite(['resources/css/styles.css', 'resources/js/validation.js','resources/js/API_Ops.js'])    {{-- if you hava npm --}}

</head>
<body>
    <header>
        <h1>@lang('myCustom.welcome')</h1>
        <nav>
            <a href="#">@lang('myCustom.Home')</a>
            <a href="#">@lang('myCustom.About')</a>
            <a href="#">@lang('myCustom.Contact')</a>
            <a href="{{ route('languageConverter', 'en') }}">English</a>
            <a href="{{ route('languageConverter', 'ar') }}">عربي</a>
        </nav>
    </header>

    <div id="error-summary" class="error-summary"></div>
    <div class="container">
        @yield('content')
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} @lang('myCustom.Registration')</p>
    </footer>
</body>
</html>
