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
    </head>
    <body class="min-w-site text-sm font-medium min-h-screen text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-900">
        <div class="flex">
            <div class="w-1/3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-full" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.56-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.56.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.147.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="w-1/3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-full" viewBox="0 0 40 40" fill="currentColor">
                    <path
                        fill="#10b981"
                        fill-rule="evenodd"
                        d="M 20 3 A 1 1 0 0 0 20 37 A 1 1 0 0 0 20 3 M 20 4 A 1 1 0 0 0 20 36 A 1 1 0 0 0 20 4 Z M 14 25 L 16 15 C 16 12 14 9 10 15 L 6 15 C 5 15 8 10 11 10 L 21 10 C 24 10 21 11 21 13 L 19 25 C 18 28 17 31 12 30 C 9 30 14 28 14 25 Z M 20 27 L 22 14 C 23 12 24 9 31 10 C 32 12 28 9 26 16 L 25 25 C 24 31 29 28 30 25 L 33 25 L 33 28 C 32 30 31 30 28 30 L 20 30 C 17 30 20 28 20 27 Z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="w-1/3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-full" viewBox="0 0 40 40" fill="none">
                    <path
                        stroke="#0ea5e9"
                        stroke-width="0.6"
                        d="M 20 6 C 12 6 12 32 20 32 C 28 32 28 6 20 6 C 1 6 1 32 20 32 C 39 32 39 6 20 6 C -5 6 -5 32 20 32 C 45 32 45 6 20 6 M 1.25 19 L 38.75 19 M 20 6 L 20 32 M 27 31.21 C 24.363 29.144 15.462 29.04 13.02 31.211 M 33.812 28.125 C 26.731 21.232 13.067 21.284 6.553 28.355 M 12.386 6.974 C 16.257 9.396 23.727 9.396 26.896 6.77 M 7.453 9.074 C 16.155 16.697 23.683 16.697 32.607 9.106"
                    />
                    <path
                        stroke="white"
                        stroke-width="0.4"
                        fill="#0284c7"
                        d="M 9.732 10.806 L 14.815 10.806 L 14.855 23.148 C 14.855 24.741 16.417 24.866 16.417 23.18 L 16.45 10.74 L 21.695 10.713 L 21.695 23.839 C 19.853 28.521 11.888 28.583 9.657 23.92 Z"
                    />
                    <path
                        stroke="white"
                        stroke-width="0.4"
                        fill="#0284c7"
                        d="M 31.284 16.558 C 31.284 13.435 31.378 10.561 26.13 10.218 C 21.539 10.28 20.571 12.279 20.383 16.183 L 20.321 22.086 C 20.665 27.146 24.725 27.583 25.381 27.396 C 26.756 27.16 27.038 26.738 27.973 25.928 L 28.953 26.95 L 31.269 26.976 L 31.326 18.165 L 25.965 18.182 L 25.948 20.339 L 26.946 20.339 L 26.962 23.429 C 26.782 24.769 25.163 24.785 25.049 23.461 L 25.033 13.915 C 25.294 12.558 26.798 12.574 26.962 13.964 L 26.962 16.579 Z"
                    />
                </svg>
            </div>
        </div>
    </body>
</html>
