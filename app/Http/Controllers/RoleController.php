<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;



class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index',['roles'=>$roles]);
    }

    public function store()
    {
        request()->validate([
            'name'=>['required'],
        ]);
        Role::create([
            'name'=>Str::ucfirst(request('name')),
            'slug'=>Str::of(Str::lower(request('name')))->slug('-'),
        ]);

        session()->flash('role-created','Role created');

        return back();
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('admin.roles.edit',[
            'role'=>$role,
            'permissions'=>$permissions,
        ]);

    }

    public function update(Role $role)
    {
        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::of(Str::lower(request('name')))->slug('-');

        if ($role->isDirty('name')){
            session()->flash('role-updated','Updated Role: ' . $role->name);
            $role->save();
        }else {
            session()->flash('role-updated','Nothing has been updated');
        }

        return back();

    }


    public function destroy(Role $role)
    {
        $role->delete();

        session()->flash('role-deleted','Deleted Role: ' .$role->name);

        return back();

    }

    public function attach(Role $role)
    {

        $role->permissions()->attach(request('permission'));

        return back();
    }

    public function detach(Role $role)
    {

        $role->permissions()->detach(request('permission'));

        return back();
    }

}
