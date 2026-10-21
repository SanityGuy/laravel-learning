
@extends('auth.layout')

@section('title', 'Choose a new password')

@section('content')
    <h1 class="text-2xl font-bold">Choose a new password</h1>

    @if ($errors->any())
        <div class="mt-4 text-sm text-red-300">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}" class="mt-6 space-y-5">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label for="email" class="mb-2 block text-sm text-slate-300">Email address</label>
            <input id="email" name="email" type="email" value="{{ old('email', $request->email) }}"
                autocomplete="email" required
                class="w-full rounded-xl border border-white/10 bg-[#080e1c] px-4 py-3 outline-none focus:border-blue-400">
        </div>

        <div>
            <label for="password" class="mb-2 block text-sm text-slate-300">New password</label>
            <input id="password" name="password" type="password" autocomplete="new-password" required
                class="w-full rounded-xl border border-white/10 bg-[#080e1c] px-4 py-3 outline-none focus:border-blue-400">
        </div>

        <div>
            <label for="password_confirmation" class="mb-2 block text-sm text-slate-300">Confirm new password</label>
            <input id="password_confirmation" name="password_confirmation" type="password"
                autocomplete="new-password" required
                class="w-full rounded-xl border border-white/10 bg-[#080e1c] px-4 py-3 outline-none focus:border-blue-400">
        </div>

        <button class="w-full rounded-xl bg-blue-500 px-4 py-3 font-semibold hover:bg-blue-400">
            Update password
        </button>
    </form>
@endsection
