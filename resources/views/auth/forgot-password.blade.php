
@extends('auth.layout')

@section('title', 'Reset password')

@section('content')
    <h1 class="text-2xl font-bold">Reset your password</h1>
    <p class="mt-2 text-sm text-slate-400">We'll send you a reset link if your email is eligible.</p>

    @if (session('status'))
        <p class="mt-4 rounded-lg bg-emerald-500/10 p-3 text-sm text-emerald-300">
            {{ session('status') }}
        </p>
    @endif

    @if ($errors->any())
        <div class="mt-4 text-sm text-red-300">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="mt-6 space-y-5">
        @csrf
        <div>
            <label for="email" class="mb-2 block text-sm text-slate-300">Email address</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}"
                autocomplete="email" required autofocus
                class="w-full rounded-xl border border-white/10 bg-[#080e1c] px-4 py-3 outline-none focus:border-blue-400">
        </div>
        <button class="w-full rounded-xl bg-blue-500 px-4 py-3 font-semibold hover:bg-blue-400">
            Send reset link
        </button>
    </form>

    <p class="mt-6 text-center text-sm">
        <a href="{{ route('login') }}" class="text-blue-400">Back to sign in</a>
    </p>
@endsection
