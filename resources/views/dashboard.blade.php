<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0b1220">
    <title>{{ $project }} | Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            color-scheme: dark;
        }

        body {
            background: #0b1220;
            color: #e2e8f0;
        }

        .panel {
            background: #111c2e;
            border: 1px solid #233149;
        }

        .surface {
            background: #0d1727;
            border: 1px solid #26354b;
        }

        .field {
            width: 100%;
            border: 1px solid #30415a;
            border-radius: 0.75rem;
            background: #0b1220;
            color: #f1f5f9;
            padding: 0.75rem 0.875rem;
            outline: none;
            transition: border-color 180ms ease, box-shadow 180ms ease;
        }

        .field:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgb(96 165 250 / 12%);
        }

        .task-card {
            animation: enter 400ms ease both;
            transition: border-color 180ms ease, transform 180ms ease;
        }

        .task-card:hover {
            border-color: #405675;
            transform: translateY(-2px);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            border-radius: 0.7rem;
            padding: 0.65rem 0.9rem;
            font-size: 0.875rem;
            font-weight: 600;
            transition: background-color 160ms ease, border-color 160ms ease,
                transform 160ms ease, opacity 160ms ease;
        }

        .btn:active {
            transform: scale(0.98);
        }

        .btn-primary {
            background: #3b82f6;
            color: #071426;
        }

        .btn-primary:hover {
            background: #60a5fa;
        }

        .btn-secondary {
            border: 1px solid #30415a;
            background: #17243a;
            color: #dbeafe;
        }

        .btn-secondary:hover {
            background: #20324c;
        }

        .btn-edit {
            border: 1px solid #1153b6;
            background: #022d77;
            color: #4f9bff;
        }

        .btn-edit:hover {
            background: #0c49a0;
        }

        .btn-danger {
            border: 1px solid #7f303c;
            background: #351923;
            color: #fda4af;
        }

        .btn-danger:hover {
            background: #4a202b;
        }

        .status-pending {
            border: 1px solid #475569;
            background: #1e293b;
            color: #cbd5e1;
        }

        .status-in_progress {
            border: 1px solid #1e40af;
            background: #172554;
            color: #93c5fd;
        }

        .status-completed {
            border: 1px solid #166534;
            background: #052e22;
            color: #86efac;
        }

        .muted {
            color: #94a3b8;
        }

        .eyebrow {
            color: #94a3b8;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .progress-track {
            height: 5px;
            overflow: hidden;
            border-radius: 999px;
            background: #26354b;
        }

        .progress-fill {
            height: 100%;
            border-radius: inherit;
            background: #60a5fa;
            transition: width 350ms ease;
        }

        .icon-box {
            display: flex;
            width: 2.6rem;
            height: 2.6rem;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border: 1px solid #30415a;
            border-radius: 0.85rem;
            background: #17243a;
            color: #93c5fd;
        }

        @keyframes enter {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
</head>

<body class="min-h-screen antialiased">
    @php
        $totalTasks = $tasks->count();
        $completedTasks = $tasks->where('status', 'completed')->count();
        $activeTasks = $tasks->where('status', 'in_progress')->count();
        $pendingTasks = $tasks->where('status', 'pending')->count();
        $completionRate = $totalTasks > 0
            ? round(($completedTasks / $totalTasks) * 100)
            : 0;
    @endphp

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 sm:py-10 lg:px-8">
        <section class="mb-8 flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
            <div>
                <p class="eyebrow mb-3">Your workspace / Overview</p>
                <h1 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                    Welcome back.
                </h1>
                <p class="mt-2 max-w-xl text-sm leading-6 text-slate-400 sm:text-base">
                    Plan your work, track your progress, and keep moving forward.
                </p>
            </div>

            <div class="flex items-center gap-3 rounded-xl border border-slate-800 bg-slate-900/60 p-3">
                <div
                    class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-500/15 font-bold text-blue-300">
                    {{ strtoupper(substr($name, 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="max-w-48 truncate text-sm font-semibold text-white">{{ $name }}</p>
                    <p class="text-xs text-slate-500">Project owner</p>
                </div>
            </div>
        </section>

        @if (session('success'))
            <div role="status"
                class="mb-6 flex items-start gap-3 rounded-xl border border-emerald-800/70 bg-emerald-950/50 p-4 text-sm text-emerald-300">
                <span aria-hidden="true">✓</span>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div role="alert" class="mb-6 rounded-xl border border-red-800/70 bg-red-950/40 p-4 text-sm text-red-300">
                <p class="mb-2 font-semibold">Please check the following:</p>
                <ul class="list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section aria-label="Task statistics" class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <article class="panel rounded-2xl p-5">
                <div class="flex items-center justify-between gap-3">
                    <p class="text-sm text-slate-400">Total tasks</p>
                    <div class="icon-box" aria-hidden="true">▤</div>
                </div>
                <p class="mt-5 text-3xl font-bold tracking-tight text-white">{{ $totalTasks }}</p>
                <p class="mt-2 text-xs text-slate-500">All tasks in your workspace</p>
            </article>

            <article class="panel rounded-2xl p-5">
                <div class="flex items-center justify-between gap-3">
                    <p class="text-sm text-slate-400">Pending</p>
                    <div class="icon-box" aria-hidden="true">◷</div>
                </div>
                <p class="mt-5 text-3xl font-bold tracking-tight text-white">{{ $pendingTasks }}</p>
                <p class="mt-2 text-xs text-slate-500">Waiting to be started</p>
            </article>

            <article class="panel rounded-2xl p-5">
                <div class="flex items-center justify-between gap-3">
                    <p class="text-sm text-slate-400">In progress</p>
                    <div class="icon-box" aria-hidden="true">↗</div>
                </div>
                <p class="mt-5 text-3xl font-bold tracking-tight text-white">{{ $activeTasks }}</p>
                <p class="mt-2 text-xs text-slate-500">Currently being worked on</p>
            </article>

            <article class="panel rounded-2xl p-5">
                <div class="flex items-center justify-between gap-3">
                    <p class="text-sm text-slate-400">Completed</p>
                    <div class="icon-box" aria-hidden="true">✓</div>
                </div>
                <p class="mt-5 text-3xl font-bold tracking-tight text-white">{{ $completedTasks }}</p>
                <p class="mt-2 text-xs text-slate-500">Successfully finished</p>
            </article>
        </section>

        <section class="mb-8 grid grid-cols-1 gap-5 lg:grid-cols-3">
            <div class="panel rounded-2xl p-5 sm:p-6 lg:col-span-2">
                <div class="mb-5 flex items-start justify-between gap-4">
                    <div>
                        <p class="eyebrow mb-2">Your progress</p>
                        <h2 class="text-xl font-bold text-white">Completion overview</h2>
                    </div>
                    <span class="text-2xl font-bold text-blue-300">{{ $completionRate }}%</span>
                </div>

                <div class="progress-track" role="progressbar" aria-label="Task completion" aria-valuemin="0"
                    aria-valuemax="100" aria-valuenow="{{ $completionRate }}">
                    <div class="progress-fill" style="width: {{ $completionRate }}%"></div>
                </div>

                <div class="mt-4 flex flex-wrap justify-between gap-2 text-sm">
                    <span class="text-slate-400">
                        {{ $completedTasks }} of {{ $totalTasks }} tasks completed
                    </span>
                    <span class="text-slate-500">
                        {{ $totalTasks - $completedTasks }} remaining
                    </span>
                </div>
            </div>

            <div class="panel flex flex-col justify-between rounded-2xl p-5 sm:p-6">
                <div>
                    <p class="eyebrow mb-2">Project information</p>
                    <h2 class="text-xl font-bold text-white">{{ $project }}</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-400">
                        Built with the tools you're learning and improving every day.
                    </p>
                </div>

                <a href="https://github.com/SanityGuy" target="_blank" rel="noopener noreferrer"
                    class="mt-2 inline-flex items-center gap-2 text-sm font-semibold text-blue-300 transition hover:text-blue-200">
                    View GitHub profile
                </a>

                <div class="mt-5 flex flex-wrap gap-2">
                    @foreach ($stack as $tech)
                        <span
                            class="rounded-full border border-slate-700 bg-slate-800/80 px-3 py-1.5 text-xs font-medium text-slate-300">
                            {{ $tech }}
                        </span>
                    @endforeach
                </div>

            </div>
        </section>

        <section id="create-task" class="panel mb-8 scroll-mt-24 rounded-2xl p-5 sm:p-6">
            <div class="mb-6">
                <p class="eyebrow mb-2">Make it happen</p>
                <h2 class="text-xl font-bold text-white">Create a new task</h2>
                <p class="mt-1 text-sm text-slate-400">Add something you want to get done.</p>
            </div>

            <form action="{{ route('tasks.store') }}" method="POST" class="grid grid-cols-1 gap-4 md:grid-cols-2">
                @csrf

                <div class="md:col-span-2">
                    <label for="title" class="mb-2 block text-sm font-medium text-slate-300">
                        Task title <span class="text-blue-400">*</span>
                    </label>
                    <input id="title" name="title" type="text" value="{{ old('title') }}" required maxlength="255"
                        placeholder="e.g. Finish the dashboard UI" class="field">
                    @error('title')
                        <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="mb-2 block text-sm font-medium text-slate-300">
                        Description
                    </label>
                    <textarea id="description" name="description" rows="3" placeholder="What needs to be done?"
                        class="field resize-y">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="due_date" class="mb-2 block text-sm font-medium text-slate-300">
                        Due date
                    </label>
                    <input id="due_date" name="due_date" type="date" value="{{ old('due_date') }}" class="field">
                    <p class="mt-2 text-xs text-slate-500">Optional. Leave empty if there is no deadline.</p>
                    @error('due_date')
                        <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                <div
                    class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-800 pt-4 md:col-span-2">
                    <p class="text-xs text-slate-500">Fields marked * are required.</p>
                    <button type="submit" class="btn btn-primary">
                        <span aria-hidden="true">+</span>
                        Create task
                    </button>
                </div>
            </form>
        </section>

        <section id="tasks" class="scroll-mt-24">
            <div class="mb-5 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                <div>
                    <p class="eyebrow mb-2">Stay organized</p>
                    <h2 class="text-2xl font-bold text-white">My tasks</h2>
                    <p class="mt-1 text-sm text-slate-400">Manage your work, one task at a time.</p>
                </div>

                <div class="flex w-full flex-col gap-3 sm:w-auto sm:flex-row">
                    <label for="task-search" class="sr-only">Search tasks</label>
                    <input id="task-search" type="search" placeholder="Search tasks..." class="field sm:w-56">

                    <label for="status-filter" class="sr-only">Filter by status</label>
                    <select id="status-filter" class="field sm:w-44">
                        <option value="all">All statuses</option>
                        <option value="pending">Pending</option>
                        <option value="in_progress">In progress</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
            </div>

            <div id="task-list" class="grid grid-cols-1 gap-5 xl:grid-cols-2">
                @forelse ($tasks as $task)
                    <article data-task-card data-status="{{ $task->status }}"
                        data-search="{{ strtolower($task->title . ' ' . ($task->description ?? '')) }}"
                        class="task-card panel rounded-2xl p-5">
                        <div class="flex items-start">
                            <div class="min-w-0 flex-1">
                                <div class="flex flex-wrap items-center gap-2">
                                    <h3 class="break-words text-base font-bold text-white">
                                        {{ $task->title }}
                                    </h3>

                                    <span class="status-{{ $task->status }} rounded-full px-2.5 py-1 text-xs font-semibold">
                                        {{ str($task->status)->replace('_', ' ')->title() }}
                                    </span>
                                </div>

                                <p class="whitespace-pre-line break-words text-sm leading-6 text-slate-400">
                                    {{ $task->description ?: 'No description provided.' }}
                                </p>

                                <p class="mt-3 text-xs text-slate-500">
                                    @if ($task->due_date)
                                        Due {{ $task->due_date->format('M j, Y') }}
                                    @else
                                        No due date
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="mt-5 border-t border-slate-800 pt-4">
                            <p class="mb-3 text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Quick actions
                            </p>

                            <div class="flex flex-wrap items-center gap-2">
                                @foreach (['pending', 'in_progress', 'completed'] as $status)
                                    @if ($task->status !== $status)
                                        <form action="{{ route('tasks.update', $task) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <input type="hidden" name="title" value="{{ $task->title }}">
                                            <input type="hidden" name="description" value="{{ $task->description }}">
                                            <input type="hidden" name="due_date" value="{{ $task->due_date?->format('Y-m-d') }}">
                                            <input type="hidden" name="status" value="{{ $status }}">

                                            <button type="submit" class="btn btn-secondary">
                                                {{ str($status)->replace('_', ' ')->title() }}
                                            </button>
                                        </form>
                                    @endif
                                @endforeach

                                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-edit">
                                    Edit
                                </a>

                                <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                    onsubmit="return confirm('Delete this task permanently?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </article>
                @empty
                    <div id="empty-state" class="panel rounded-2xl px-5 py-12 text-center xl:col-span-2">
                        <div
                            class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl border border-slate-700 bg-slate-800 text-2xl text-blue-300">
                            +
                        </div>
                        <h3 class="text-lg font-bold text-white">Your workspace starts here</h3>
                        <p class="mx-auto mt-2 max-w-sm text-sm leading-6 text-slate-400">
                            You haven't created any tasks yet. Add your first task above and get started.
                        </p>
                        <a href="#create-task" class="btn btn-primary mt-5">Create your first task</a>
                    </div>
                @endforelse
            </div>

            <p id="no-results"
                class="mt-4 hidden rounded-xl border border-slate-800 p-8 text-center text-sm text-slate-400">
                No tasks match your search or selected filter.
            </p>
        </section>

        <footer class="mt-12 border-t border-slate-800 py-6 text-center">
            <p class="text-xs text-slate-500">
                {{ $project }} · Built with Laravel, Blade & Tailwind CSS
            </p>
            <p class="mt-2 text-xs text-slate-600">
                Made by {{ $name }} · Keep building.
            </p>
        </footer>
    </main>

    <script>
        const searchInput = document.getElementById('task-search');
        const statusFilter = document.getElementById('status-filter');
        const taskCards = [...document.querySelectorAll('[data-task-card]')];
        const noResults = document.getElementById('no-results');

        function filterTasks() {
            const query = searchInput.value.trim().toLowerCase();
            const status = statusFilter.value;
            let visibleCount = 0;

            taskCards.forEach((card) => {
                const matchesText = card.dataset.search.includes(query);
                const matchesStatus = status === 'all' || card.dataset.status === status;
                const visible = matchesText && matchesStatus;

                card.hidden = !visible;

                if (visible) visibleCount++;
            });

            noResults.classList.toggle('hidden', visibleCount !== 0 || taskCards.length === 0);
        }

        searchInput.addEventListener('input', filterTasks);
        statusFilter.addEventListener('change', filterTasks);
    </script>
</body>

</html>