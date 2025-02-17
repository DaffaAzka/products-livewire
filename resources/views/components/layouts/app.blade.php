<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
    <title>{{ $title }}</title>
</head>
<body class="bg-gray-50">

    <x-navbar></x-navbar>

    <div class="my-0 md:m-0">
        <div class="h-full flex items-center justify-center m-8">
            <div class="w-11/12 max-w p-5 pb-8 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                {{ $slot }}

            </div>
        </div>
    </div>

@livewireScripts

</body>
</html>
