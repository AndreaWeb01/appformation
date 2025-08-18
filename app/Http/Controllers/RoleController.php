<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
public function index()
    {
        $roles = Role::all();
        return view('dashboard.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('dashboard.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'permissions' => 'array|required'
        ]);


        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('status', 'Role enregistré avec succès');

    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('dashboard.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name,'.$role->id,
            'permissions' => 'array|required',
        ]);

        $role->update([
            'name' => $request->name
        ]);

        $role->syncPermissions($request->permissions);

        return redirect('roles')->with('status','Role Modifié avec succès');
    }

    public function destroy($roleId)
    {
        $role = Role::find($roleId);
        $role->delete();
        return redirect('roles')->with('status','Role supprimé avec succès');
    }

}
