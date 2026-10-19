<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | Laravel</title>
    @vite('resources/css/app.css')
</head>

<body class="flex flex-col min-h-[100vh] justify-center text-center bg-slate-950">
    <div class="flex flex-col gap-2 text-slate-100 font-medium shadow-lg w-full">
        <h1 class="text-5xl font-bold">Welcome to {{ $name }}'s Project!</h1>
        <p class="text-3xl">The project is called {{ $project }}.</p>
        <div class="max-w-xl p-3 bg-zinc-900 rounded-xl shadow-lg">
            <p class="text-2xl">Project is made using these stacks:</p>
            <div class="flex gap-2 items-center justify-center mt-2">
                @foreach ($stack as $tech)
                    <span class="rounded-full bg-slate-800 px-3 py-1 text-sm text-white">{{ $tech }}</span>
                @endforeach
            </div>
        </div>
    </div>
</body>

</html>