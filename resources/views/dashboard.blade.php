<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | Laravel</title>
    @vite('resources/css/app.css')
</head>

<body class="flex flex-col min-h-[100vh] justify-center items-center text-center bg-slate-950">
    <section class="mt-8 w-full max-w-4xl px-4">
        <div class="flex flex-col gap-2 items-center text-slate-100 font-medium shadow-lg w-full">
            <h1 class="text-3xl sm:text-5xl font-bold">Welcome to {{ $name }}'s Project!</h1>
            <p class="text-3xl">The project is called {{ $project }}.</p>
            <div class="max-w-xl p-5 bg-slate-900 rounded-xl shadow-lg mt-2">
                <p class="text-2xl">The project is made using these stacks:</p>
                <div class="flex gap-2 items-center justify-center mt-5">
                    @foreach ($stack as $tech)
                        <span class="rounded-full bg-slate-800 px-3 py-1 text-sm text-white">{{ $tech }}</span>
                    @endforeach
                </div>
            </div>
            <p class="text-xl mt-2 font-sm text-slate-200">Want to see more? <a href="/about"
                    class="font-bold text-blue-500 hover:text-blue-600 shadow-lg">Click here</a></p>
        </div>
    </section>
    <section class="mt-8 w-full max-w-2xl px-4 text-left">
        <form action="{{ route('tasks.store') }}" method="POST"
            class="space-y-4 rounded-xl border border-slate-800 bg-slate-900 p-5">

            @csrf

            <h2 class="text-2xl font-bold text-white">
                Create a task
            </h2>

            @if (session('success'))
                <p class="rounded-lg bg-emerald-950 p-3 text-emerald-300">
                    {{ session('success') }}
                </p>
            @endif

            @if ($errors->any())
                <div class="rounded-lg bg-red-950 p-3 text-red-300">
                    <ul class="list-inside list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <label for="title" class="mb-1 block text-slate-200">
                    Task title
                </label>

                <input id="title" name="title" type="text" value="{{ old('title') }}" required maxlength="255"
                    class="w-full rounded-lg border border-slate-700 bg-slate-950 p-3 text-white">
            </div>

            <div>
                <label for="description" class="mb-1 block text-slate-200">
                    Description
                </label>

                <textarea id="description" name="description" rows="3"
                    class="w-full rounded-lg border border-slate-700 bg-slate-950 p-3 text-white">{{ old('description') }}</textarea>
            </div>

            <div>
                <label for="due_date" class="mb-1 block text-slate-200">
                    Due date
                </label>

                <input id="due_date" name="due_date" type="date" value="{{ old('due_date') }}"
                    class="w-full rounded-lg border border-slate-700 bg-slate-950 p-3 text-white">
            </div>

            <button type="submit" class="rounded-lg bg-blue-600 px-5 py-3 font-bold text-white hover:bg-blue-500">
                Create task
            </button>
        </form>
    </section>
    <section class="mt-8 w-full max-w-2xl px-4">
        <h2 class="mb-4 text-2xl font-bold text-white">
            My Tasks
        </h2>

        @forelse ($tasks as $task)
            <article class="mb-3 rounded-xl border border-slate-800 bg-slate-900 p-4 text-left">
                <h3 class="text-lg font-semibold text-white">
                    {{ $task->title }}
                </h3>

                <p class="mt-1 text-slate-400">
                    {{ $task->description }}
                </p>

                <span class="mt-3 inline-block rounded-full bg-slate-800 px-3 py-1 text-sm text-blue-300">
                    {{ str_replace('_', ' ', ucfirst($task->status)) }}
                </span>
            </article>
        @empty
            <p class="text-slate-400">
                No tasks yet. Your mission starts here.
            </p>
        @endforelse
    </section>
</body>

</html>