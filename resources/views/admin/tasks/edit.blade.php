@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="rounded-[32px] border border-slate-200 bg-white/90 p-6 shadow-sm">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.18em] text-slate-500">Admin control</p>
                <h1 class="mt-2 text-3xl font-semibold text-slate-900">Edit Tugas</h1>
                <p class="mt-2 text-sm text-slate-600">Perbarui detail tugas untuk pengalaman pengguna yang lebih baik.</p>
            </div>
            <a href="{{ route('admin.tasks.index') }}" class="rounded-full border border-slate-300 bg-white px-4 py-2 shadow-sm">Kembali ke Tugas</a>
        </div>
    </div>

    <div class="overflow-hidden rounded-[32px] border border-slate-200 bg-white/90 p-6 shadow-sm">
        <form method="POST" action="{{ route('admin.tasks.update', $task) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-slate-700">Judul</label>
                <input type="text" name="title" value="{{ old('title', $task->title) }}" class="mt-2 w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900" />
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700">Kategori</label>
                <input type="text" name="category" value="{{ old('category', $task->category) }}" class="mt-2 w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900" />
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700">Deskripsi</label>
                <textarea name="description" rows="4" class="mt-2 w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900">{{ old('description', $task->description) }}</textarea>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-slate-700">Poin</label>
                    <input type="number" name="points" value="{{ old('points', $task->points) }}" class="mt-2 w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Target</label>
                    <input type="text" name="target" value="{{ old('target', $task->target) }}" class="mt-2 w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900" />
                </div>
            </div>
            <button type="submit" class="rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white">Perbarui Tugas</button>
        </form>
    </div>
</div>
@endsection
