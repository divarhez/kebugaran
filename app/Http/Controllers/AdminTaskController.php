<?php

namespace App\Http\Controllers;

use App\Models\HealthTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminTaskController extends Controller
{
    public function index()
    {
        $this->authorizeAdmin();

        $tasks = HealthTask::orderByDesc('points')->get();

        return view('admin.tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    public function create()
    {
        $this->authorizeAdmin();

        return view('admin.tasks.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'points' => ['required', 'integer', 'min:1'],
            'target' => ['nullable', 'string', 'max:255'],
        ]);

        HealthTask::create($data);

        return redirect()->route('admin.tasks.index')->with('status', 'Tugas baru berhasil dibuat.');
    }

    public function edit(HealthTask $task)
    {
        $this->authorizeAdmin();

        return view('admin.tasks.edit', [
            'task' => $task,
        ]);
    }

    public function update(Request $request, HealthTask $task)
    {
        $this->authorizeAdmin();

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'points' => ['required', 'integer', 'min:1'],
            'target' => ['nullable', 'string', 'max:255'],
        ]);

        $task->update($data);

        return redirect()->route('admin.tasks.index')->with('status', 'Tugas berhasil diperbarui.');
    }

    public function destroy(HealthTask $task)
    {
        $this->authorizeAdmin();

        $task->delete();

        return back()->with('status', 'Tugas berhasil dihapus.');
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
