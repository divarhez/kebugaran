@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="rounded-[32px] border border-slate-200 bg-white/90 p-6 shadow-sm">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.18em] text-slate-500">Admin control</p>
                <h1 class="mt-2 text-3xl font-semibold text-slate-900">Manajemen Pengguna</h1>
                <p class="mt-2 text-sm text-slate-600">Lihat semua akun, perbarui peran, atau hapus pengguna yang tidak aktif.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="rounded-full border border-slate-300 bg-white px-4 py-2 shadow-sm">Kembali ke Dashboard</a>
        </div>
    </div>

    @if(session('status'))
        <div class="rounded-3xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">{{ session('status') }}</div>
    @endif
    @if(session('error'))
        <div class="rounded-3xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">{{ session('error') }}</div>
    @endif

    <div class="overflow-hidden rounded-[32px] border border-slate-200 bg-white/90 shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 font-semibold text-slate-700">Nama</th>
                    <th class="px-6 py-4 font-semibold text-slate-700">Email</th>
                    <th class="px-6 py-4 font-semibold text-slate-700">Peran</th>
                    <th class="px-6 py-4 font-semibold text-slate-700">Terdaftar</th>
                    <th class="px-6 py-4 font-semibold text-slate-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @foreach($users as $user)
                    <tr>
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">{{ ucfirst($user->role) }}</td>
                        <td class="px-6 py-4">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 space-x-2">
                            @if(auth()->id() !== $user->id)
                                <form method="POST" action="{{ route('admin.users.updateRole', $user) }}" class="inline-flex">
                                    @csrf
                                    <select name="role" class="rounded-full border border-slate-300 bg-slate-50 px-3 py-2 text-sm text-slate-700">
                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                    <button type="submit" class="rounded-full bg-slate-900 px-4 py-2 text-sm text-white">Simpan</button>
                                </form>
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline-flex" onsubmit="return confirm('Hapus pengguna ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-full bg-rose-600 px-4 py-2 text-sm text-white">Hapus</button>
                                </form>
                            @else
                                <span class="inline-flex rounded-full bg-slate-100 px-3 py-2 text-sm text-slate-700">Sedang login</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
