<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <title>@yield('title')</title>
</head>
<body class="bg-gray-200">

    <header class="container mx-auto px-4">
        <nav class="py-4 flex justify-evenly bg-white rounded-md my-5">
            <a href="{{route('weather')}}" class="text-orange-500 hover:text-orange-600 p-1 px-2 {{ (request()->is('/')) ? 'border-b border-current' : '' }}">Weather</a>
            <a href="{{route('position')}}" class="text-orange-500 hover:text-orange-600 p-1 px-2 {{ (request()->is('position')) ? 'border-b border-current' : '' }}">Position</a>
            <a href="{{route('statistics')}}" class="text-orange-500 hover:text-orange-600 p-1 px-2 {{ (request()->is('statistics')) ? 'border-b border-current' : '' }}">Statistics</a>
        </nav>
    </header>

    @yield('content')

    <script type="text/javascript" id="cookiebanner" 
        src="https://cdn.jsdelivr.net/gh/dobarkod/cookie-banner@1.2.2/dist/cookiebanner.min.js"
        data-message="We use cookies to improve your browsing experience."
        data-bg="#F97316"
        data-fg="#ffffff"
        data-link="#7C2D12"
        data-font-size=".9rem"
        >
    </script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <style>
        .cookiebanner {
            padding-top: .9rem !important;
            padding-bottom: .9rem !important;
        }
    </style>
</body>
</html>