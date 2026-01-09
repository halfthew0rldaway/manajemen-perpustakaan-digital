<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of petugas (admin only)
     */
    public function index()
    {
        // Only admin can access
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $users = User::where('role', 'petugas')
            ->orderBy('name')
            ->paginate(20);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new petugas
     */
    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        return view('users.create');
    }

    /**
     * Store a newly created petugas
     */
    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'petugas',
            'is_active' => true,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Petugas berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified petugas
     */
    public function edit(User $user)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        // Prevent editing admin
        if ($user->isAdmin()) {
            abort(403, 'Cannot edit admin user');
        }

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified petugas
     */
    public function update(Request $request, User $user)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        // Prevent editing admin
        if ($user->isAdmin()) {
            abort(403, 'Cannot edit admin user');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'Data petugas berhasil diperbarui!');
    }

    /**
     * Remove the specified petugas
     */
    public function destroy(User $user)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        // Prevent deleting admin
        if ($user->isAdmin()) {
            abort(403, 'Cannot delete admin user');
        }

        // Check if petugas has processed loans
        if ($user->loansProcessed()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Tidak dapat menghapus petugas yang sudah memproses transaksi!');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Petugas berhasil dihapus!');
    }

    /**
     * Toggle petugas status
     */
    public function toggleStatus(User $user)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        // Prevent deactivating admin
        if ($user->isAdmin()) {
            abort(403, 'Cannot deactivate admin user');
        }

        $user->is_active = !$user->is_active;
        $user->save();

        $statusText = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->back()
            ->with('success', "Petugas berhasil {$statusText}!");
    }
}
