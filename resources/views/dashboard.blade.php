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
            <h1 class="text-4xl text-slate-100 inline-block">{{ $project }}</h1>
            <h3 class="text-2xl text-slate-300 inline-block">
                Made by
                <a href="https://github.com/SanityGuy" class="font-bold text-sky-500 hover:text-sky-600 shadow-lg"
                    target="_blank" rel="noreferrer" title="Github Page">{{ $name }}</a>
            </h3>
            <div class="max-w-xl p-5 bg-slate-900 rounded-xl shadow-lg mt-2">
                <p class="text-2xl">The project is made using these stacks:</p>
                <div class="flex gap-2 items-center justify-center mt-5">
                    @foreach ($stack as $tech)
                        <span class="rounded-full bg-slate-800 px-3 py-1 text-sm text-white">{{ $tech }}</span>
                    @endforeach
                </div>
            </div>
            <p class="text-xl mt-2 text-sm text-slate-200">Want to know more? <a href="/about"
                    class="font-bold text-sky-500 hover:text-sky-600 shadow-lg">Click here</a></p>
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

            <button type="submit"
                class="inline-block rounded-lg bg-sky-500 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-400">
                Create New Task
            </button>
        </form>
    </section>
    <section class="mt-8 w-full max-w-2xl px-4">
        <h2 class="mb-4 text-2xl font-bold text-white">
            My Tasks
        </h2>

        @forelse ($tasks as $task)
            <article class="mb-5 mt-5 rounded-xl border border-slate-800 bg-slate-900 p-4 text-left">

                <div class="m-1 flex flex-col">
                    <h3 class="text-xl font-semibold text-white">
                        {{ $task->title }}
                        <span class="inline-block ml-1 mb-1 rounded-full bg-slate-800 px-3 py-2 text-sm text-blue-300">
                            {{ str_replace('_', ' ', ucfirst($task->status)) }}
                        </span>
                    </h3>

                    <p class="mt-1 text-slate-400">
                        {{ $task->description }}
                    </p>
                </div>

                <div class="flex flex-col gap-2 p-2 px-2 py-2 bg-slate-800 mt-3 rounded-xl">
                    <h1 class="text-base font-bold text-slate-500 m-1">
                        Quick Actions
                    </h1>
                    <hr class="w-full text-slate-700 mb-2" />
                    <div class="flex flex-row gap-2">
                        @foreach (['pending', 'in_progress', 'completed'] as $status)
                            <form action="{{ route('tasks.status', $task) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <input type="hidden" name="status" value="{{ $status }}">

                                <button type="submit" @disabled($task->status === $status)
                                    class="rounded-lg border border-sky-500 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-500 disabled:cursor-not-allowed disabled:opacity-40">
                                    {{ str($status)->replace('_', ' ')->title() }}
                                </button>
                            </form>
                        @endforeach
                        <div class="w-0.5 h-10 bg-slate-700"></div>
                        <a href="{{ route('tasks.edit', $task) }}"
                            class="rounded-lg bg-sky-500 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-400">
                            Edit Task
                        </a>

                        <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this task?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="rounded-lg bg-red-500 px-4 py-2 text-sm font-semibold text-white hover:bg-red-400">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <p class="text-slate-400">
                No tasks yet. Your mission starts here.
            </p>
        @endforelse
    </section>
</body>

</html>