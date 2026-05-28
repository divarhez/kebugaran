<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Kebugaranku') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#f2f7fb] text-slate-900">
        <div class="min-h-screen bg-[radial-gradient(circle_at_top,_rgba(56,189,248,0.15),_transparent_28%),radial-gradient(circle_at_bottom_right,_rgba(14,165,233,0.18),_transparent_30%)]">
            <header class="mx-auto flex max-w-6xl items-center justify-between px-6 py-6">
                <a href="/" class="text-2xl font-semibold">Kebugaranku</a>
                <div class="flex items-center gap-3">
                    <a href="{{ route('login') }}" class="rounded-full border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-900 shadow-sm">Login</a>
                    <a href="{{ route('register') }}" class="rounded-full bg-slate-900 px-4 py-2 text-sm font-medium text-white shadow-sm">Daftar</a>
                </div>
            </header>

            <main class="mx-auto flex max-w-6xl flex-col gap-12 px-6 py-12 lg:flex-row lg:items-center">
                <section class="max-w-2xl space-y-8 rounded-[32px] border border-slate-200 bg-white/90 p-10 shadow-xl shadow-slate-200/70">
                    <div class="space-y-4">
                        <p class="text-sm uppercase tracking-[0.28em] text-sky-600">Aplikasi Kesehatan & Kebugaran</p>
                        <h1 class="text-5xl font-semibold tracking-tight text-slate-900">Jadikan hidup sehat lebih mudah dan lebih menyenangkan.</h1>
                        <p class="max-w-xl text-lg leading-8 text-slate-600">Pantau kebiasaan makan, tidur, olahraga, dan kesehatan mental dalam satu dashboard. Naik level setiap hari dengan menyelesaikan misi sehat.</p>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="rounded-3xl bg-slate-50 p-5">
                            <p class="text-sm font-semibold text-slate-900">Level & Pencapaian</p>
                            <p class="mt-2 text-sm text-slate-600">Dapatkan XP untuk setiap kebiasaan sehat yang kamu selesaikan.</p>
                        </div>
                        <div class="rounded-3xl bg-slate-50 p-5">
                            <p class="text-sm font-semibold text-slate-900">Catatan Harian</p>
                            <p class="mt-2 text-sm text-slate-600">Isi tidur, air, langkah, kalori, dan mood untuk melihat tren mingguan.</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('register') }}" class="rounded-2xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">Mulai sekarang</a>
                        <a href="{{ route('login') }}" class="rounded-2xl border border-slate-900 px-6 py-3 text-sm font-semibold text-slate-900 hover:bg-slate-100">Lihat demo</a>
                    </div>
                </section>

                <section class="rounded-[32px] bg-gradient-to-br from-sky-200 to-cyan-100 p-10 shadow-xl shadow-sky-200/50">
                    <div class="space-y-6">
                        <div class="rounded-3xl bg-white/90 p-6 shadow-sm">
                            <p class="text-sm uppercase tracking-[0.18em] text-sky-700">Aplikasi modern</p>
                            <h2 class="mt-3 text-3xl font-semibold text-slate-900">Motivasi harian dengan sistem leveling.</h2>
                        </div>
                        <div class="grid gap-4">
                            <div class="rounded-3xl bg-white/90 p-5 shadow-sm">
                                <p class="text-sm font-semibold text-slate-900">Selesaikan tugas sehat</p>
                                <p class="mt-2 text-slate-600">Dapatkan poin setiap kali kamu minum cukup air, bergerak, dan tidur cukup.</p>
                            </div>
                            <div class="rounded-3xl bg-white/90 p-5 shadow-sm">
                                <p class="text-sm font-semibold text-slate-900">Lacak kemajuan harian</p>
                                <p class="mt-2 text-slate-600">Ikuti perkembanganmu dan tingkatkan ritme hidup sehat secara konsisten.</p>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </body>
</html>
