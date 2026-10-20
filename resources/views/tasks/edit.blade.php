<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-950 text-white p-6">
    <main class="mx-auto max-w-2xl">
        <a href="/" class="text-sky-400 hover:text-sky-300">
            ← Back to dashboard
        </a>

        <h1 class="mt-8 text-3xl font-bold">Edit Task</h1>
        <p class="mt-2 text-slate-400">Update your task details.</p>

        @if ($errors->any())
            <div class="mt-6 rounded-lg bg-red-950 p-4 text-red-300">
                <ul class="list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.update', $task) }}" method="POST"
            class="mt-6 space-y-5 rounded-xl border border-slate-800 bg-slate-900 p-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="mb-2 block text-sm font-medium">
                    Title
                </label>
                <input id="title" name="title" value="{{ old('title', $task->title) }}" required maxlength="255"
                    class="w-full rounded-lg border border-slate-700 bg-slate-950 p-3">
            </div>

            <div>
                <label for="description" class="mb-2 block text-sm font-medium">
                    Description
                </label>
                <textarea id="description" name="description" rows="4"
                    class="w-full rounded-lg border border-slate-700 bg-slate-950 p-3">{{ old('description', $task->description) }}</textarea>
            </div>

            <div>
                <label for="status" class="mb-2 block text-sm font-medium">
                    Status
                </label>
                <select id="status" name="status" required
                    class="w-full rounded-lg border border-slate-700 bg-slate-950 p-3">
                    @foreach (['pending', 'in_progress', 'completed'] as $status)
                        <option value="{{ $status }}" @selected(old('status', $task->status) === $status)>
                            {{ str($status)->replace('_', ' ')->title() }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="due_date" class="mb-2 block text-sm font-medium">
                    Due Date
                </label>
                <input id="due_date" name="due_date" type="date"
                    value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}"
                    class="w-full rounded-lg border border-slate-700 bg-slate-950 p-3">
            </div>

            <button type="submit"
                class="w-full rounded-lg bg-sky-500 px-4 py-3 font-semibold text-slate-950 hover:bg-sky-400">
                Save Changes
            </button>
        </form>
    </main>
</body>

</html>