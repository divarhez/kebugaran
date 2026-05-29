@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="rounded-[32px] border border-slate-200 bg-white/90 p-6 shadow-sm">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.18em] text-slate-500">Admin control</p>
                <h1 class="mt-2 text-3xl font-semibold text-slate-900">Manajemen Tugas</h1>
                <p class="mt-2 text-sm text-slate-600">Buat, edit, dan hapus tugas kesehatan yang tersedia untuk pengguna.</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.dashboard') }}" class="rounded-full border border-slate-300 bg-white px-4 py-2 shadow-sm">Kembali ke Dashboard</a>
                <a href="{{ route('admin.tasks.create') }}" class="rounded-full bg-slate-900 px-4 py-2 text-white shadow-sm">Tugas Baru</a>
            </div>
        </div>
    </div>

    @if(session('status'))
        <div class="rounded-3xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">{{ session('status') }}</div>
    @endif

    <div class="overflow-hidden rounded-[32px] border border-slate-200 bg-white/90 shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 font-semibold text-slate-700">Judul</th>
                    <th class="px-6 py-4 font-semibold text-slate-700">Kategori</th>
                    <th class="px-6 py-4 font-semibold text-slate-700">Poin</th>
                    <th class="px-6 py-4 font-semibold text-slate-700">Target</th>
                    <th class="px-6 py-4 font-semibold text-slate-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @foreach($tasks as $task)
                    <tr>
                        <td class="px-6 py-4">{{ $task->title }}</td>
                        <td class="px-6 py-4">{{ $task->category }}</td>
                        <td class="px-6 py-4">{{ $task->points }}</td>
                        <td class="px-6 py-4">{{ $task->target }}</td>
                        <td class="px-6 py-4 space-x-2">
                            <a href="{{ route('admin.tasks.edit', $task) }}" class="rounded-full border border-slate-300 bg-white px-4 py-2 text-sm text-slate-900">Edit</a>
                            <form method="POST" action="{{ route('admin.tasks.destroy', $task) }}" class="inline-flex" onsubmit="return confirm('Hapus tugas ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-full bg-rose-600 px-4 py-2 text-sm text-white">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
