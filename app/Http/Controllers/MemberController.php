<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of members
     */
    public function index(Request $request)
    {
        $query = Member::query();

        // Search
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('member_id_number', 'like', "%{$search}%")
                    ->orWhere('occupation_institution', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $members = $query->orderBy('name')->paginate(20);

        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new member
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created member
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'member_id_number' => 'required|string|unique:members,member_id_number|max:255',
            'occupation_institution' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
        ]);

        $validated['status'] = 'active';

        Member::create($validated);

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil ditambahkan!');
    }

    /**
     * Display the specified member
     */
    public function show(Member $member)
    {
        $member->load([
            'loans' => function ($query) {
                $query->with('book')->latest();
            }
        ]);

        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified member
     */
    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified member
     */
    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'member_id_number' => 'required|string|max:255|unique:members,member_id_number,' . $member->id,
            'occupation_institution' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
        ]);

        $member->update($validated);

        return redirect()->route('members.index')
            ->with('success', 'Data anggota berhasil diperbarui!');
    }

    /**
     * Remove the specified member (admin only)
     */
    public function destroy(Member $member)
    {
        // Check if admin
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        // Check if member has active loans
        if ($member->activeLoans()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Tidak dapat menghapus anggota yang masih memiliki peminjaman aktif!');
        }

        $member->delete();

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil dihapus!');
    }

    /**
     * Toggle member status (admin only)
     */
    public function toggleStatus(Member $member)
    {
        // Check if admin
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        // Check if member has active loans before deactivating
        if ($member->status === 'active' && $member->activeLoans()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Tidak dapat menonaktifkan anggota yang masih memiliki peminjaman aktif!');
        }

        $member->status = $member->status === 'active' ? 'inactive' : 'active';
        $member->save();

        $statusText = $member->status === 'active' ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->back()
            ->with('success', "Anggota berhasil {$statusText}!");
    }
}
