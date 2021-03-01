<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{

    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index',['permissions'=>$permissions]);
    }


    public function store()
    {

        request()->validate([
            'name'=>['required'],
        ]);
        Permission::create([
            'name'=>Str::ucfirst(request('name')),
            'slug'=>Str::of(Str::lower(request('name')))->slug('-'),
        ]);

        session()->flash('permission-created','Permission created');

        return back();
    }


    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit',[
            'permission'=>$permission,
        ]);

    }

    public function update(Permission $permission)
    {
        request()->validate([
            'name'=>'required',
        ]);
        $permission->name = Str::ucfirst(request('name'));
        $permission->slug = Str::of(Str::lower(request('name')))->slug('-');

        if ($permission->isDirty('name')){
            session()->flash('permission-updated','Updated Permission: ' . $permission->name);
            $permission->save();
        }else {
            session()->flash('permission-updated','Nothing has been updated');
        }

        return back();

    }






    public function destroy(Permission $permission)
    {
        $permission->delete();

        session()->flash('permission-deleted','Deleted permission: ' . $permission->name);

        return back();

    }




}
