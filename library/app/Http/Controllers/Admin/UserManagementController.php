<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserManagementController extends Controller
{
    // Menampilkan semua user
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Edit user
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required|in:user,admin',
        ]);

        $user->update($request->only('name','email','role'));
        return redirect()->route('users.index')->with('success','User updated successfully');
    }

    // Hapus user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success','User deleted successfully');
    }
}
