<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Example App</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <!-- Styles -->
        @vite('resources/css/app.css')
        @livewireStyles
    </head>
    <body>
        <div class="pt-0 pl-4 pr-4 bg-white border border-gray-200 rounded-lg shadow-md sm:p-6 lg:p-8 dark:bg-gray-800 dark:border-gray-700" aria-label="Subscribe to the Flowbite newsletter">
            <div data-style="clean" class="items-end mb-3">
                @livewire('index')
            </div>
        </div>

        @livewireScripts
        @vite('resources/js/app.js')
    </body>
</html>
