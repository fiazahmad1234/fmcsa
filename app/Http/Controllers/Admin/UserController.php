<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    
    // Show all users with roles
    public function index()
    {
        // Eager load roles
        $users = User::with('roles')->get();

        return view('index', compact('users'));
    }

    // Assign role to user
    public function assignRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,editor,user'
        ]);

        $user = User::findOrFail($id);

        // Sync role (remove old, assign new)
        $user->syncRoles([$request->role]);

        return redirect()->back()->with('success', 'Role updated successfully!');
    }
}
