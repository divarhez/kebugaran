@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-md rounded-3xl border border-slate-200 bg-white/90 p-8 shadow-xl shadow-slate-200/50 backdrop-blur-xl">
    <h1 class="text-3xl font-semibold text-slate-900">Masuk ke Kebugaranku</h1>
    <p class="mt-2 text-sm text-slate-600">Kelola target harian dan naikkan level kesehatanmu.</p>

    <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-slate-700">Email</label>
            <input name="email" type="email" value="{{ old('email') }}" required autofocus class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-slate-900 focus:outline-none" />
            @error('email')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700">Kata sandi</label>
            <input name="password" type="password" required class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-slate-900 focus:outline-none" />
            @error('password')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
        </div>

        <button type="submit" class="w-full rounded-2xl bg-slate-900 px-4 py-3 text-white transition hover:bg-slate-800">Masuk</button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-600">Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-slate-900">Daftar sekarang</a></p>
</div>
@endsection
