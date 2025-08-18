<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        // $users = User::all();
        
        $users = User::all()->filter(function ($user) {
            return !$user->hasRole('super admin');
        });
        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        // $roles = Role::pluck('name','name')->all();
        $roles = Role::where('name', '!=', 'super admin')->pluck('name', 'name')->all();
        return view('dashboard.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:20',
            'roles' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->roles);

        return redirect()->route('users.index')->with('status','Utilisateur créé avec succès');
    }

    public function edit(User $user)
    {
        // $roles = Role::pluck('name','name')->all();
        // $userRoles = $user->roles->pluck('name','name')->all();

        $roles = Role::where('name', '!=', 'super admin')->pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();
        return view('dashboard.users.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'. $user->id,
            // 'password' => 'nullable|string|min:8|max:20',
            'roles' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        $user->update($data);
        $user->syncRoles($request->roles);

        return redirect()->route('users.index')->with('status','Utilisateur mis à jour avec succès');
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect()->route('users.index')->with('status','Utilisateur supprimé avec succès');
    }
}
