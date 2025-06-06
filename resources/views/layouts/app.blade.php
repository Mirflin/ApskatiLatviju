<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @vite(['resources/css/dashboard.css'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @if($view_name == 'dashboard')
                <aside class="dashboard-aside">
                    <div class="options">
                        <div class="parrent-option">
                            <div class="parrent-label">
                                <div>
                                    <img class="parrent-image">
                                    <p class="function-p">name</p>
                                </div>
                                <div>
                                    <i class="fa-solid fa-circle-plus" style="color: #74C0FC;"></i>
                                    <i class="fa-solid fa-chevron-up"></i>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                            </div>
                            <div class="child-option">
                                <div class="child active">
                                    <img class="child-option-image">
                                    <div class="child-option-text">
                                        <p>sommething</p>
                                        <p>sommething</p>
                                    </div>
                                </div>
                                <div class="child">
                                    <img class="child-option-image">
                                    <div class="child-option-text">
                                        <p>sommething</p>
                                        <p>sommething</p>
                                    </div>
                                </div>
                                <div class="child">
                                    <img class="child-option-image">
                                    <div class="child-option-text">
                                        <p>sommething</p>
                                        <p>sommething</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="parrent-label">
                            <div>
                                <img class="parrent-image">
                                <p class="function-p">name</p>
                            </div>
                        </div>

                        <div class="parrent-option">
                            <div class="parrent-label">
                                <div>
                                    <img class="parrent-image">
                                    <p class="function-p">name</p>
                                </div>
                                <div>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="aside-footer">
                        <div class="parrent-option">
                            <div class="parrent-label">
                                <div>
                                    <img class="parrent-image">
                                    <p class="function-p">name</p>
                                </div>
                                <div>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="theme-changer">
                            <div class="white">
                                <img>
                                <p></p>
                            </div>
                            <div class="black">
                                <img>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </aside>
                @endif
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
