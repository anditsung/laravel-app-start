<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full font-sans antialiased">
    <head>
        <meta name="theme-color" content="#fff">
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="locale" content="{{ str_replace('_', '-', app()->getLocale()) }}"/>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('app.css') }}">

        <!-- Scripts -->
        @routes
        <script>
            if (localStorage.novaTheme === 'dark' || (!('novaTheme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark')
            } else {
                document.documentElement.classList.remove('dark')
            }
        </script>
    </head>
    <body class="min-w-site text-sm font-medium min-h-screen text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-900">
        @inertia

        <!-- Scripts -->
        <script src="{{ mix('manifest.js') }}"></script>
        <script src="{{ mix('vendor.js') }}"></script>
        <script src="{{ mix('app.js') }}"></script>

        <script>
            const config = @json(\App\Nova::jsonVariables(request()));
            window.Nova = createNovaApp(config)
            Nova.countdown()
        </script>

        <script defer>
            Nova.liftOff()
        </script>
    </body>
</html>
