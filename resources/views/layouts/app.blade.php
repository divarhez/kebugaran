<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ config('app.name', 'Kebugaranku') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[#f2f7fb] text-slate-900 font-sans">
        <div class="min-h-screen bg-[radial-gradient(circle_at_top,_rgba(168,236,255,0.35),_transparent_35%),radial-gradient(circle_at_bottom_right,_rgba(99,102,241,0.18),_transparent_35%)]">
            <header class="mx-auto max-w-6xl px-4 py-6 flex items-center justify-between gap-4">
                <a href="/" class="text-xl font-semibold text-slate-900">Kebugaranku</a>
                <nav class="flex items-center gap-3 text-sm">
                    @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="rounded-full border border-slate-300 bg-white px-4 py-2 shadow-sm">Admin Dashboard</a>
                        <a href="{{ route('admin.users.index') }}" class="rounded-full border border-slate-300 bg-white px-4 py-2 shadow-sm">Manajemen User</a>
                        <a href="{{ route('admin.tasks.index') }}" class="rounded-full border border-slate-300 bg-white px-4 py-2 shadow-sm">Manajemen Tugas</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="rounded-full border border-slate-300 bg-white px-4 py-2 shadow-sm">Dashboard</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="rounded-full border border-slate-300 bg-slate-900 px-4 py-2 text-white shadow-sm">Logout</button>
                    </form>
                @else
                        <a href="{{ route('login') }}" class="rounded-full border border-slate-300 bg-white px-4 py-2 shadow-sm">Login</a>
                        <a href="{{ route('register') }}" class="rounded-full bg-slate-900 px-4 py-2 text-white shadow-sm">Daftar</a>
                    @endauth
                </nav>
            </header>

            <main class="mx-auto max-w-6xl px-4 pb-16">
                @yield('content')
            </main>
        </div>
    </body>
</html>
