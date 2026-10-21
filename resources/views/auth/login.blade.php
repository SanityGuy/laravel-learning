
@extends('auth.layout')

@section('title', 'Sign in')

@section('content')
    <h1 class="text-2xl font-bold tracking-tight">Welcome back</h1>
    <p class="mt-2 text-sm text-slate-400">Sign in to continue to your workspace.</p>

    @if (session('status'))
        <p class="mt-4 rounded-lg bg-emerald-500/10 p-3 text-sm text-emerald-300">
            {{ session('status') }}
        </p>
    @endif

    @if ($errors->any())
        <div class="mt-4 rounded-lg border border-red-400/20 bg-red-400/10 p-3 text-sm text-red-300">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="mt-7 space-y-5">
        @csrf

        <div>
            <label for="email" class="mb-2 block text-sm font-medium text-slate-300">Email address</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}"
                autocomplete="email" required autofocus
                class="w-full rounded-xl border border-white/10 bg-[#080e1c] px-4 py-3 outline-none transition focus:border-blue-400 focus:ring-2 focus:ring-blue-400/20">
        </div>

        <div>
            <div class="mb-2 flex items-center justify-between gap-3">
                <label for="password" class="text-sm font-medium text-slate-300">Password</label>
                <a href="{{ route('password.request') }}" class="text-xs text-blue-400 hover:text-blue-300">
                    Forgot password?
                </a>
            </div>
            <input id="password" name="password" type="password"
                autocomplete="current-password" required
                class="w-full rounded-xl border border-white/10 bg-[#080e1c] px-4 py-3 outline-none transition focus:border-blue-400 focus:ring-2 focus:ring-blue-400/20">
        </div>

        <label class="flex items-center gap-2 text-sm text-slate-400">
            <input type="checkbox" name="remember" value="1"
                class="rounded border-white/20 bg-[#080e1c] text-blue-500 focus:ring-blue-500">
            Remember me
        </label>

        <button type="submit"
            class="w-full rounded-xl bg-blue-500 px-4 py-3 font-semibold text-white transition hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-offset-2 focus:ring-offset-[#101a2b]">
            Sign in
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-400">
        New here?
        <a href="{{ route('register') }}" class="font-semibold text-blue-400 hover:text-blue-300">Create an account</a>
    </p>
@endsection
