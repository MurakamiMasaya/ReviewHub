<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="google-site-verification" content="LLQhqQHY18QguUtCc2bEz_PqejITZ4_d7BUtmy66xl4" />
        <meta property="og:image" content="{{  asset('images/logo.png') }}" />

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{{ asset('images/GR.png') }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen">
            <div id="app">
                @include('layouts.navigation')
    
                <!-- Page Content -->
                <main id="main" class="w-full">
                    {{ $slot }}
                </main>
    
                @include('layouts.footer')
            </div>
        </div>
        <script src="https://unpkg.com/flowbite@1.4.4/dist/flowbite.js"></script>
        {{-- <script src="{{ asset('js/adjustTopMargin.js') }}"></script> --}}
        <script src="{{ asset('js/review.js') }}"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>
