<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>F1 Ranker - {{ config('app.name', 'Laravel') }}</title>

    <!-- F1 Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@400;500;600;700&display=swap" rel="stylesheet">



    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-teko antialiased">

    <div class="min-h-screen bg-[#050505] relative">
        <div class="f1-bg fixed inset-0 pointer-events-none"></div>
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-[#0a0a0a]/95 shadow-2xl border-b border-gray-800/50 backdrop-blur-md relative z-20">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="relative z-20 pt-0 pb-20">
            {{ $slot }}
        </main>
    </div>

    <style>
        .f1-title {
            font-family: 'Teko', sans-serif;
        }



        nav.bg-white {
            background-color: #0a0a0a !important;
            border-bottom: 1px solid #222 !important;
        }

        nav .text-gray-500,
        nav .text-gray-800,
        nav a {
            color: #e5e5e5 !important;
        }

        header.bg-white {
            background-color: #0a0a0a !important;
            border-bottom: 1px solid #222 !important;
        }

        .f1-bg {
            background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        .f1-bg::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 50% -10%, rgba(226, 0, 26, 0.15) 0%, transparent 70%);
        }

        body,
        .min-h-screen {
            background-color: #050505 !important;
            color: #ffffff !important;
        }

        html {
            overflow-x: hidden;
        }
    </style>
</body>

</html>