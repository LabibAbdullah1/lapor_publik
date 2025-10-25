<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Hanya admin yang boleh lihat semua user
    public function index()
    {
        if (Auth::user()->role !== 'admin') abort(403)->with('message', 'Kamu tidak memiliki izin untuk mengakses halaman ini.');
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // Hanya admin yang boleh membuat user baru
    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|integer|max:18|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Admin atau user sendiri boleh edit
    public function edit(User $user)
    {
        if (Auth::id() !== $user->id && Auth::user()->role !== 'admin') {
            abort(403)->with('message', 'Kamu tidak memiliki izin untuk mengakses halaman ini.');
        }

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (Auth::id() !== $user->id && Auth::user()->role !== 'admin') {
            abort(403)->with('message', 'Kamu tidak memiliki izin untuk mengakses halaman ini.');
        }

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ];

        // Admin boleh ubah role, user tidak
        if (Auth::user()->role === 'admin') {
            $rules['role'] = 'required|in:admin,staff,user';
        }

        // NIK tidak boleh diubah oleh siapapun kecuali admin
        if (Auth::user()->role !== 'admin') {
            unset($request['nik']);
        }

        $validated = $request->validate($rules);
        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403)->with('message', 'Kamu tidak memiliki izin untuk mengakses halaman ini.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
