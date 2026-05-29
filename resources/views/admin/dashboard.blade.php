@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="rounded-[32px] border border-slate-200 bg-white/90 p-6 shadow-sm">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.18em] text-slate-500">Admin control</p>
                <h1 class="mt-2 text-3xl font-semibold text-slate-900">Dashboard Admin</h1>
                <p class="mt-2 text-sm text-slate-600">Ringkasan cepat aktivitas pengguna, tugas, dan entri kesehatan.</p>
            </div>
            <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-3">
                <div class="rounded-3xl bg-slate-50 p-4 text-center">
                    <p class="text-sm text-slate-500">Pengguna terdaftar</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $totalUsers }}</p>
                </div>
                <div class="rounded-3xl bg-slate-50 p-4 text-center">
                    <p class="text-sm text-slate-500">Tugas tersedia</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $totalTasks }}</p>
                </div>
                <div class="rounded-3xl bg-slate-50 p-4 text-center">
                    <p class="text-sm text-slate-500">Penyelesaian total</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $totalCompletions }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid gap-6 xl:grid-cols-[1.5fr_1fr]">
        <div class="space-y-6">
            <article class="rounded-[32px] border border-slate-200 bg-white/90 p-6 shadow-sm">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm uppercase tracking-[0.18em] text-slate-500">Kinerja harian</p>
                        <h2 class="mt-2 text-2xl font-semibold text-slate-900">Statistik hari ini</h2>
                    </div>
                    <p class="text-sm text-slate-600">Data real-time dari entri dan penyelesaian tugas.</p>
                </div>

                <div class="mt-6 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-sm text-slate-500">Entri kesehatan hari ini</p>
                        <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $todayEntries }}</p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-sm text-slate-500">Tugas selesai hari ini</p>
                        <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $todayCompletions }}</p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-sm text-slate-500">Rata-rata langkah hari ini</p>
                        <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $avgStepsToday }}<span class="text-base font-medium"> langkah</span></p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-sm text-slate-500">Rata-rata tidur hari ini</p>
                        <p class="mt-2 text-3xl font-semibold text-slate-900">{{ number_format($avgSleepToday, 1) }}<span class="text-base font-medium"> jam</span></p>
                    </div>
                </div>
            </article>

            <article class="rounded-[32px] border border-slate-200 bg-white/90 p-6 shadow-sm">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm uppercase tracking-[0.18em] text-slate-500">Top pengguna</p>
                        <h2 class="mt-2 text-2xl font-semibold text-slate-900">XP terbesar</h2>
                    </div>
                    <p class="text-sm text-slate-600">Pengguna dengan poin paling tinggi di platform.</p>
                </div>

                <div class="mt-6 space-y-3">
                    @foreach($mostActiveUsers as $index => $topUser)
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4 flex items-center justify-between gap-4">
                            <div>
                                <p class="text-sm text-slate-500">#{{ $index + 1 }} {{ $topUser->name }}</p>
                                <p class="text-sm text-slate-600">{{ $topUser->email }}</p>
                            </div>
                            <div class="rounded-full bg-slate-100 px-3 py-2 text-sm font-semibold text-slate-700">{{ $topUser->experience }} XP</div>
                        </div>
                    @endforeach
                </div>
            </article>
        </div>

        <aside class="space-y-6">
            <article class="rounded-[32px] border border-slate-200 bg-white/90 p-6 shadow-sm">
                <div>
                    <p class="text-sm uppercase tracking-[0.18em] text-slate-500">Pengguna terbaru</p>
                    <h2 class="mt-2 text-2xl font-semibold text-slate-900">Daftar pendaftar baru</h2>
                </div>

                <div class="mt-6 space-y-3">
                    @foreach($recentUsers as $recentUser)
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                            <p class="font-semibold text-slate-900">{{ $recentUser->name }}</p>
                            <p class="text-sm text-slate-600">{{ $recentUser->email }}</p>
                            <p class="text-sm text-slate-500">{{ $recentUser->created_at->translatedFormat('d M Y H:i') }}</p>
                        </div>
                    @endforeach
                </div>
            </article>

            <article class="rounded-[32px] border border-slate-200 bg-white/90 p-6 shadow-sm">
                <div>
                    <p class="text-sm uppercase tracking-[0.18em] text-slate-500">Tugas populer hari ini</p>
                    <h2 class="mt-2 text-2xl font-semibold text-slate-900">Tugas paling sering diselesaikan</h2>
                </div>

                <div class="mt-6 space-y-3">
                    @foreach($topTasks as $task)
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p class="font-semibold text-slate-900">{{ $task->title }}</p>
                                    <p class="text-sm text-slate-600">{{ $task->category }}</p>
                                </div>
                                <span class="rounded-full bg-slate-100 px-3 py-2 text-sm font-semibold text-slate-700">{{ $task->today_completions }}x</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </article>

            <article class="rounded-[32px] border border-slate-200 bg-white/90 p-6 shadow-sm">
                <div>
                    <p class="text-sm uppercase tracking-[0.18em] text-slate-500">Tugas terbaik</p>
                    <h2 class="mt-2 text-2xl font-semibold text-slate-900">Tugas dengan penyelesaian terbanyak</h2>
                </div>

                <div class="mt-6 space-y-3">
                    @foreach($bestTasksOverall as $task)
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p class="font-semibold text-slate-900">{{ $task->title }}</p>
                                    <p class="text-sm text-slate-600">{{ $task->category }}</p>
                                </div>
                                <span class="rounded-full bg-slate-100 px-3 py-2 text-sm font-semibold text-slate-700">{{ $task->completions_count }}x</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </article>
        </aside>
    </div>
</div>
@endsection
