@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-md rounded-3xl border border-slate-200 bg-white/90 p-8 shadow-xl shadow-slate-200/50 backdrop-blur-xl">
    <h1 class="text-3xl font-semibold text-slate-900">Buat akun Kebugaranku</h1>
    <p class="mt-2 text-sm text-slate-600">Mulai pantau kesehatan, catat kebiasaan harian, dan naikkan level fitness-mu.</p>

    <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-slate-700">Nama lengkap</label>
            <input name="name" type="text" value="{{ old('name') }}" required class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-slate-900 focus:outline-none" />
            @error('name')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700">Email</label>
            <input name="email" type="email" value="{{ old('email') }}" required class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-slate-900 focus:outline-none" />
            @error('email')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700">Kata sandi</label>
            <input name="password" type="password" required class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-slate-900 focus:outline-none" />
            @error('password')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700">Konfirmasi kata sandi</label>
            <input name="password_confirmation" type="password" required class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-slate-900 focus:outline-none" />
        </div>

        <button type="submit" class="w-full rounded-2xl bg-slate-900 px-4 py-3 text-white transition hover:bg-slate-800">Daftar</button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-600">Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-slate-900">Masuk di sini</a></p>
</div>
@endsection
