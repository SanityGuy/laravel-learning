
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Authentication') · Taskflow</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#080e1c] text-slate-100 antialiased">
    <main class="flex min-h-screen items-center justify-center px-5 py-12">
        <div class="w-full max-w-md">
            <a href="/" class="mb-8 flex items-center justify-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-500 text-xl font-black text-white shadow-lg shadow-blue-500/20">T</span>
                <span class="text-xl font-bold tracking-tight">Taskflow</span>
            </a>

            <section class="rounded-2xl border border-white/10 bg-[#101a2b] p-7 shadow-2xl sm:p-9">
                @yield('content')
            </section>

            <p class="mt-6 text-center text-xs text-slate-500">
                Simple tasks. Clear progress.
            </p>
        </div>
    </main>
</body>
</html>
