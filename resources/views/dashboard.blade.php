@extends('layouts.app')

@section('content')
<div class="grid gap-6 lg:grid-cols-[320px_1fr]">
    <section class="rounded-[32px] border border-slate-200 bg-white/90 p-6 shadow-sm">
        <div class="space-y-4">
            <div>
                <p class="text-sm uppercase tracking-[0.18em] text-sky-600">Halo, {{ $user->name }}</p>
                <h1 class="mt-2 text-3xl font-semibold text-slate-900">Dashboard Kebugaran</h1>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                <p class="text-sm text-slate-500">Level saat ini</p>
                <div class="mt-3 flex items-center justify-between gap-4">
                    <div>
                        <p class="text-4xl font-semibold text-slate-900">{{ $user->level }}</p>
                        <p class="text-sm text-slate-600">{{ $user->experience }} XP</p>
                    </div>
                    <span class="rounded-full bg-sky-100 px-4 py-2 text-sm font-medium text-sky-700">{{ $user->experience_to_next_level }} XP ke Level {{ $user->level + 1 }}</span>
                </div>
                <div class="mt-4 h-4 overflow-hidden rounded-full bg-slate-200">
                    <div class="h-full rounded-full bg-sky-600" style="width: {{ $user->level_progress }}%"></div>
                </div>
            </div>

            <div class="grid gap-3">
                <div class="rounded-3xl border border-slate-200 bg-slate-50 px-5 py-4">
                    <p class="text-sm text-slate-500">Target harian yang selesai</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-900">{{ count($completedToday) }} / {{ count($tasks) }}</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-slate-50 px-5 py-4">
                    <p class="text-sm text-slate-500">Logging kesehatan hari ini</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $entry ? 'Sudah tersimpan' : 'Belum diisi' }}</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-slate-50 px-5 py-4">
                    <p class="text-sm text-slate-500">XP minggu ini</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $weeklyXp }} XP</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-slate-50 px-5 py-4">
                    <p class="text-sm text-slate-500">Streak harian</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $streak }} hari</p>
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-6">
        @if(session('status'))
            <div class="rounded-3xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800">{{ session('status') }}</div>
        @endif

        <article class="rounded-[32px] border border-slate-200 bg-white/90 p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.18em] text-slate-500">Tugas harian</p>
                    <h2 class="mt-2 text-2xl font-semibold text-slate-900">Selesaikan kebiasaan sehat</h2>
                </div>
                <p class="max-w-xl text-sm text-slate-600">Tiap tugas memberi poin supaya kamu dapat naik level dan membentuk rutinitas sehat.</p>
            </div>

            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                @foreach($tasks as $task)
                    <div class="rounded-3xl border border-slate-200 p-5 shadow-sm">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="text-sm uppercase tracking-[0.18em] text-slate-500">{{ $task->category }}</p>
                                <h3 class="mt-2 text-lg font-semibold text-slate-900">{{ $task->title }}</h3>
                            </div>
                            <div class="rounded-2xl bg-slate-100 px-3 py-2 text-sm font-semibold text-slate-700">+{{ $task->points }}</div>
                        </div>
                        <p class="mt-3 text-sm leading-6 text-slate-600">{{ $task->description }}</p>
                        <p class="mt-4 text-sm text-slate-500">Target: {{ $task->target }}</p>
                        <form action="{{ route('tasks.complete', $task) }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit" class="w-full rounded-2xl px-4 py-3 text-sm font-semibold transition" @if(in_array($task->id, $completedToday)) disabled @endif style="background-color: {{ in_array($task->id, $completedToday) ? '#d1d5db' : '#0f172a' }}; color: white;">
                                {{ in_array($task->id, $completedToday) ? 'Selesai hari ini' : 'Tandai selesai' }}
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </article>

        <article class="rounded-[32px] border border-slate-200 bg-white/90 p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.18em] text-slate-500">Catatan harian</p>
                    <h2 class="mt-2 text-2xl font-semibold text-slate-900">Data kesehatan hari ini</h2>
                </div>
                <p class="max-w-xl text-sm text-slate-600">Isi tidur, air, langkah, dan suasana hati agar kamu tetap konsisten.</p>
            </div>

            <form action="{{ route('entry.store') }}" method="POST" class="mt-6 grid gap-4 lg:grid-cols-2">
                @csrf
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">Jam tidur</label>
                    <input type="number" name="sleep_hours" step="0.1" min="0" max="24" value="{{ old('sleep_hours', $entry?->sleep_hours) }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-slate-900" required>
                    @error('sleep_hours')<p class="text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">Gelas air</label>
                    <input type="number" name="water_glasses" min="0" max="20" value="{{ old('water_glasses', $entry?->water_glasses) }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-slate-900" required>
                    @error('water_glasses')<p class="text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">Langkah</label>
                    <input type="number" name="steps" min="0" value="{{ old('steps', $entry?->steps) }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-slate-900" required>
                    @error('steps')<p class="text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">Kalori</label>
                    <input type="number" name="calories" min="0" value="{{ old('calories', $entry?->calories) }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-slate-900" required>
                    @error('calories')<p class="text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>
                <div class="space-y-4 lg:col-span-2">
                    <label class="block text-sm font-medium text-slate-700">Suasana hati</label>
                    <input name="mood" value="{{ old('mood', $entry?->mood) }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-slate-900" placeholder="Contoh: segar, tenang, termotivasi" required>
                    @error('mood')<p class="text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>
                <div class="space-y-4 lg:col-span-2">
                    <label class="block text-sm font-medium text-slate-700">Catatan singkat</label>
                    <textarea name="note" rows="3" class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-slate-900">{{ old('note', $entry?->note) }}</textarea>
                    @error('note')<p class="text-sm text-rose-600">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="lg:col-span-2 rounded-2xl bg-slate-900 px-4 py-3 text-white transition hover:bg-slate-800">Simpan catatan hari ini</button>
            </form>
        </article>

        <article class="rounded-[32px] border border-slate-200 bg-white/90 p-6 shadow-sm">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm uppercase tracking-[0.18em] text-slate-500">Riwayat 7 hari</p>
                    <h2 class="mt-2 text-2xl font-semibold text-slate-900">Perkembanganmu minggu ini</h2>
                </div>
                <p class="text-sm text-slate-600">Lihat kebiasaan harian dan gunakan tren ini untuk tetap konsisten.</p>
            </div>

            <div class="mt-6 space-y-3">
                @forelse($weeklyEntries as $day)
                    <div class="rounded-3xl border border-slate-200 px-5 py-4 bg-slate-50">
                        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <p class="font-semibold text-slate-900">{{ $day->date->translatedFormat('l, d F Y') }}</p>
                                <p class="text-sm text-slate-600">{{ $day->mood }} · {{ $day->points_earned }} XP</p>
                            </div>
                            <div class="flex flex-wrap gap-2 text-sm text-slate-700">
                                <span>{{ $day->sleep_hours }} jam tidur</span>
                                <span>{{ $day->water_glasses }} gelas air</span>
                                <span>{{ $day->steps }} langkah</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="rounded-3xl border border-slate-200 px-5 py-8 text-center text-slate-500">Belum ada catatan mingguan. Mulai isi catatan kesehatan sekarang.</div>
                @endforelse
            </div>
        </article>
    </section>
</div>
@endsection
