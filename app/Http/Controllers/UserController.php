<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(5);

        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $inputs = request()->validate([
            'name'      =>'required | max:20 | min:8',
            'username'  =>'required | max:20 | min:8',
            'email'     =>'required | email',
            'password'  =>'required '
        ]);

        if (request('avatar')){
            $inputs['avatar'] = request('avatar')->store('images');
        }

        User::create($inputs);

        return redirect(route('users.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $roles = Role::all();
        return view('admin.users.profile',[
            'user'=>$user,
            'roles'=>$roles
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        $inputs = request()->validate([
            'name'=>['required','string','max:255'],
            'username'=>['required','string','max:255','alpha_dash'],
            'email'=>['required','email','max:255'],

            'avatar'=>'file'

        ]);

        if (request('avatar')){
            $inputs['avatar'] = request('avatar')->store('images');
        }

        $user->update($inputs);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        session()->flash('user-deleted-message','User was Deleted');

        return back();
    }

    public function attach(User $user)
    {

        $user->roles()->attach(request('role'));

        return back();
    }

    public function detach(User $user)
    {

        $user->roles()->detach(request('role'));

        return back();
    }
}
