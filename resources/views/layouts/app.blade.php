<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    @livewireStyles



    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-sans antialiased bg-gray-100 flex flex-col min-h-screen @if (isset($style)) {{ $style }} @endif max-h-fit">

    <livewire:component.nav />

    {{ $slot }}

    @livewireScripts
    <script src="{{ asset('assets/js/jq.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>

{{-- <body class="flex flex-col min-h-screen h-screen">
    <livewire:chat.chat-page />
    <livewire:chat.chat-page />
</body> --}}

</html>
