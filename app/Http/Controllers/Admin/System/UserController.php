<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Http\Requests\Admin\System\StoreUserRequest;
use App\Http\Requests\Admin\System\UpdateUserRequest;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('username', 'like', '%' . $request->search . '%');
            });
        }
        
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(10)->appends($request->query());

        return view('admin.system.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.system.user.create');
    }

    public function store(StoreUserRequest $request)
    {

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'status' => 'active',
        ]);

        return redirect()->route('admin.user.index')->with('success', 'Admin baru berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.system.user.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {

        $data = [
            'status' => $request->status,
        ];

        if ($user->role === 'admin') {
            $data['name'] = $request->name;
            $data['username'] = $request->username;
            $data['email'] = $request->email;
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.user.index')->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        // Don't allow deleting yourself
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.user.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // Only allow deleting admin role from here
        if ($user->role !== 'admin') {
            return redirect()->route('admin.user.index')->with('error', 'Hanya akun Admin yang dapat dihapus dari menu ini. Untuk menghapus Guru/Siswa, gunakan menu Data Guru/Siswa.');
        }

        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'Akun admin berhasil dihapus.');
    }
}
