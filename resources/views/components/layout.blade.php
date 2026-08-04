<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Flashcard App' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
</head>
<body class="min-h-screen bg-[#f7f8fc] text-[#172554]">

    <x-nav></x-nav>

    <main class="container mx-auto p-6">
        {{ $slot }}
    </main>

</body>
</html>
