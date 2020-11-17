<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:roles_read')->only(['index']);
        $this->middleware('permission:roles_create')->only(['create', 'store']);
        $this->middleware('permission:roles_update')->only(['edit', 'update']);
        $this->middleware('permission:roles_delete')->only(['delete']);
    }

    public function index()
    {
        $roles = Role::whereRoleNot(['super_admin', 'admin'])
            ->whenSearch(request()
                ->search)->orderBy('id', 'desc')
            ->with('permissions')
            ->withCount('users')
            ->paginate(8);
        return view('dashboard.roles.index', compact('roles'));
    } // end of index

    public function create()
    {
        return view('dashboard.roles.create');
    } // end of create

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|unique:roles,name',
            'permissions' => 'required|array|min:1',
        ]);
        $role = Role::create($request->all());
        $role->attachPermissions($request->input('permissions'));
        toast('Data created successfully', 'success');
        return redirect()->route('dashboard.roles.index');
    } // end of store

    public function edit($id)
    {
        $role = Role::find($id);
        if (!$role) {
            toast('Data not found !!', 'error');
            return redirect()->route('dashboard.roles.index');
        }
        return view('dashboard.roles.edit', compact('role'));
    } // end of edit

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $request->validate([
            'name' => 'required|min:5|unique:roles,name,' . $role->id,
            'permissions' => 'required|array|min:1',
        ]);
        if (!$role) {
            toast('Data not found !!', 'error');
            return redirect()->route('dashboard.roles.index');
        }
        $role->update($request->except('_token'));
        $role->syncPermissions($request->input('permissions'));
        toast('Data updated successfully', 'success');
        return redirect()->route('dashboard.roles.index');
    } // end of update

    public function destroy($id)
    {
        $role = Role::find($id);
        if (!$role) {
            toast('Data not found !!', 'error');
            return redirect()->route('dashboard.roles.index');
        }
        $role->delete();
        toast('Data deleted successfully', 'success');
        return redirect()->route('dashboard.roles.index');
    } // end of destroy

}// end of controller
