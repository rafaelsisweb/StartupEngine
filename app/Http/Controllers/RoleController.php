<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use App\User;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->input('s') !== null) {
            $roles = \App\Role::where('name', 'ILIKE', '%' . $request->input('s') . '%')->orWhere('display_name', 'ILIKE', '%'.$request->input('s').'%')->limit(100)->orderBy('updated_at', 'desc')->get();
        } else {
            $roles = Role::withCount('users')->get();
        }
        return view('app.role.index')->with('roles', $roles);
    }

    public function addRole(Request $request)
    {
        $permissions = Permission::all()->groupBy('guard_name');
        $role = new Role();
        return view('app.role.add')->with('role', $role)->with('permissions', $permissions);
    }

    public function edit($id)
    {
        $permissions = Permission::all()->groupBy('guard_name');
        $role = Role::find($id);
        return view('app.role.edit')->with('role', $role)->with('permissions', $permissions);
    }

    public function saveRole(Request $request) {
        if(\Auth::user()->hasPermissionTo('edit roles')) {
            $role = Role::where('id', '=', $request->input('id'))->first();
            if($role == null) {
                $role = new \App\Role();
            }
            if($request->input('display_name') !== null) {
                $role->display_name = $request->input('display_name');
            }
            if($request->input('name') !== null) {
                $role->name = $request->input('name');
            }
            $role->save();
            if($request->input('permissions') !== null) {
                foreach ($request->input('permissions') as $permission => $value) {
                    if ($value == "on") {
                        $permissions[] = $permission;
                    }
                }
                $role->syncPermissions($permissions);
            }
        }
        return redirect('/app/roles');
    }
}
