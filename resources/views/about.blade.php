<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
</head>

<body class="flex flex-col min-h-[100vh] justify-center items-center text-center bg-slate-950">
    <div class="flex flex-col gap-2 items-center text-slate-100 font-medium shadow-lg w-full">
        <h1 class="text-5xl font-bold">{{ $title }}</h1>
        <p class="text-3xl">{{ $description }}</p>
        <hr class="h-1 w-full text-slate-900 max-w-4xl mt-5 mb-5" />
        <a href="/" class="font-bold text-blue-500 hover:text-blue-600 shadow-lg">Go back to home</a>
    </div>
</body>

</html>