<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Search by name or email
        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        }

        // Filter by role
        if ($role = $request->input('role')) {
            $query->where('role', $role);
        }

        // Paginate the results
        $users = $query->paginate(10);

        return view('admin.index', compact('users'));
    }

    public function create()
    {
        return view('admin.create');
    }
    public function show(User $user)
    {
        // Pastikan hanya admin atau pengguna terkait yang dapat melihat detailnya
        if (auth()->id() !== $user->id && auth()->user()->role !== User::ROLE_ADMIN) {
            abort(403, 'Anda tidak memiliki izin untuk melihat data ini.');
        }
    
        $user->load('mahasiswas'); // Load relasi mahasiswas
        return view('admin.show', compact('user'));
    }
    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,asisten',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dibuat.');
    }

    public function edit(User $user)
    {
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'nullable|in:admin,asisten',
        ]);

        // Pastikan hanya admin yang dapat mengubah role
        if (Auth::user()->role !== User::ROLE_ADMIN) {
            $validated['role'] = $user->role; // Gunakan role yang sudah ada
        }

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? bcrypt($validated['password']) : $user->password,
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        // Cek apakah pengguna yang login adalah admin
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak memiliki izin untuk menghapus pengguna.');
        }

        // Cegah admin menghapus dirinya sendiri
        if (auth()->user()->id === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // Hapus pengguna
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}