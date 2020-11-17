<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:users_read')->only(['index']);
        $this->middleware('permission:users_create')->only(['create', 'store']);
        $this->middleware('permission:users_update')->only(['edit', 'update']);
        $this->middleware('permission:users_delete')->only(['delete']);
    }

    public function index()
    {
        $roles = Role::whereRoleNot(['super_admin'])->get();
        $users = User::whereRoleNot('super_admin')
            ->whenSearch(request()->search)
            ->whenRole(request()->role_id)
            ->orderBy('id', 'desc')
            ->with('roles')
            ->paginate(8);
        return view('dashboard.users.index', compact('users', 'roles'));
    } // end of index

    public function create()
    {
        $roles = Role::whereRoleNot(['super_admin', 'admin'])->get();
        return view('dashboard.users.create', compact('roles'));
    } // end of create

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'role_id' => 'required|numeric|min:1',
        ]);
        $request->merge(['password' => bcrypt($request->input('password'))]);
        $user = User::create($request->all());
        $user->attachRoles(['admin', $request->input('role_id')]);
        toast('Data created successfully', 'success');
        return redirect()->route('dashboard.users.index');
    } // end of store

    public function edit($id)
    {
        $roles = Role::whereRoleNot(['super_admin', 'admin'])->get();
        $user = User::find($id);
        if (!$user) {
            toast('Data not found !!', 'error');
            return redirect()->route('dashboard.users.index');
        }
        return view('dashboard.users.edit', compact('user', 'roles'));
    } // end of edit

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            toast('Data not found !!', 'error');
            return redirect()->route('dashboard.users.index');
        }
        $request->validate([
            'name' => 'required|min:5|unique:users,name,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|numeric|min:1',
        ]);
        $user->update($request->except('_token'));
        $user->syncRoles(['admin', $request->input('role_id')]);
        toast('Data updated successfully', 'success');
        return redirect()->route('dashboard.users.index');
    } // end of update

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            toast('Data not found !!', 'error');
            return redirect()->route('dashboard.users.index');
        }
        $user->delete();
        toast('Data deleted successfully', 'success');
        return redirect()->route('dashboard.users.index');
    } // end of destroy

} // end of controller
