<?php

namespace Davidcb\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Pagination;
use Davidcb\Users\Http\Requests\RoleFormRequest;
use Davidcb\Users\Models\Permission;
use Davidcb\Users\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('name')->paginate(20);

        $pagination = new Pagination($roles, $perPage = 20, request()->except('page'));
        $roles = $pagination->results();

        return view('users::role.index', compact('roles', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('users::role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Davidcb\Users\Http\Requests\RoleFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleFormRequest $request)
    {
        $role = Role::create($request->all());
        $role->permissions()->sync($request->permissions);

        session()->flash('status', 'Grupo de usuario creado correctamente');

        return redirect(route('admin.roles.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Davidcb\Users\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('users::role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Davidcb\Users\Http\Requests\RoleFormRequest  $request
     * @param  \Davidcb\Users\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleFormRequest $request, Role $role)
    {
        $role->fill($request->all());
        $role->permissions()->sync($request->permissions);

        if ($role->isDirty()) {
            $role->save();
        }

        session()->flash('status', 'Grupo de usuario actualizado correctamente');

        return redirect(route('admin.roles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Davidcb\Users\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        return $role->delete() ? 'ok' : 'error';
    }
}
