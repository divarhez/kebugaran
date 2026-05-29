<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index()
    {
        $this->authorizeAdmin();

        $users = User::orderByDesc('created_at')->get();

        return view('admin.users', [
            'users' => $users,
        ]);
    }

    public function updateRole(Request $request, User $user)
    {
        $this->authorizeAdmin();

        $data = $request->validate([
            'role' => ['required', 'in:user,admin'],
        ]);

        if ($user->id === Auth::id()) {
            return back()->with('error', 'Kamu tidak dapat mengubah peran admin sendiri di sini.');
        }

        $user->update(['role' => $data['role']]);

        return back()->with('status', "Peran pengguna {$user->name} berhasil diperbarui.");
    }

    public function destroy(User $user)
    {
        $this->authorizeAdmin();

        if ($user->id === Auth::id()) {
            return back()->with('error', 'Kamu tidak dapat menghapus akun admin yang sedang login.');
        }

        $user->delete();

        return back()->with('status', "Pengguna {$user->name} telah dihapus.");
    }

    private function authorizeAdmin()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (! $user || ! $user->isAdmin()) {
            abort(403);
        }
    }
}
