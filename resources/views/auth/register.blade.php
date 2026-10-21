
@extends('auth.layout')

@section('title', 'Create account')

@section('content')
    <h1 class="text-2xl font-bold tracking-tight">Create your account</h1>
    <p class="mt-2 text-sm text-slate-400">Your personal workspace starts here.</p>

    @if ($errors->any())
        <div class="mt-4 rounded-lg border border-red-400/20 bg-red-400/10 p-3 text-sm text-red-300">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="mt-7 space-y-5">
        @csrf

        <div>
            <label for="name" class="mb-2 block text-sm font-medium text-slate-300">Full name</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}"
                autocomplete="name" maxlength="255" required autofocus
                class="w-full rounded-xl border border-white/10 bg-[#080e1c] px-4 py-3 outline-none transition focus:border-blue-400 focus:ring-2 focus:ring-blue-400/20">
        </div>

        <div>
            <label for="email" class="mb-2 block text-sm font-medium text-slate-300">Email address</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}"
                autocomplete="email" maxlength="255" required
                class="w-full rounded-xl border border-white/10 bg-[#080e1c] px-4 py-3 outline-none transition focus:border-blue-400 focus:ring-2 focus:ring-blue-400/20">
        </div>

        <div>
            <label for="password" class="mb-2 block text-sm font-medium text-slate-300">Password</label>
            <input id="password" name="password" type="password"
                autocomplete="new-password" required
                class="w-full rounded-xl border border-white/10 bg-[#080e1c] px-4 py-3 outline-none transition focus:border-blue-400 focus:ring-2 focus:ring-blue-400/20">
        </div>

        <div>
            <label for="password_confirmation" class="mb-2 block text-sm font-medium text-slate-300">Confirm password</label>
            <input id="password_confirmation" name="password_confirmation" type="password"
                autocomplete="new-password" required
                class="w-full rounded-xl border border-white/10 bg-[#080e1c] px-4 py-3 outline-none transition focus:border-blue-400 focus:ring-2 focus:ring-blue-400/20">
        </div>

        <button type="submit"
            class="w-full rounded-xl bg-blue-500 px-4 py-3 font-semibold text-white transition hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-offset-2 focus:ring-offset-[#101a2b]">
            Create account
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-400">
        Already registered?
        <a href="{{ route('login') }}" class="font-semibold text-blue-400 hover:text-blue-300">Sign in</a>
    </p>
@endsection
