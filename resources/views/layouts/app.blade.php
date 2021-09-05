<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @hasSection('title')
            @yield('title') - {{ config('app.name') }}
        @else
            {{ config('app.name') }}
        @endif
    </title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- <link rel="stylesheet" href="https://rsms.me/inter/inter.css"> -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css" crossorigin="anonymous" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles
</head>

<body class="font-sans antialised {{ session('theme') }}">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="flex flex-col">
            <div class="flex flex-col h-screen">
                <div class="md:flex">
                    @include('layouts.app.top-header')
                </div>
                <div class="flex flex-grow overflow-hidden">
                    <x-main-menu class="flex-shrink-0 hidden w-56 p-12 overflow-y-auto bg-gray-800 md:block">
                    </x-main-menu>
                    <div class="w-full px-4 py-8 overflow-hidden overflow-y-auto md:p-12">
                        <FlashMessages></FlashMessages>
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    @livewireScripts
</body>

</html>
