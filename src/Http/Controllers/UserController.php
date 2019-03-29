<?php

namespace Davidcb\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Pagination;
use Davidcb\Users\Http\Requests\UserFormRequest;
use Davidcb\Users\Models\Role;
use Davidcb\Users\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name')->paginate(20);

        $pagination = new Pagination($users, $perPage = 20, request()->except('page'));
        $users = $pagination->results();

        return view('users::user.index', compact('users', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('users::user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Davidcb\Users\Http\Requests\UserFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        $user = User::create($request->all());

        session()->flash('status', 'Usuario creado correctamente');

        return redirect(route('admin.users.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Davidcb\Users\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::get();
        return view('users::user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Davidcb\Users\Http\Requests\UserFormRequest  $request
     * @param  \Davidcb\Users\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, User $user)
    {
        $user->fill($request->all());

        if ($user->isDirty()) {
            $user->save();
        }

        session()->flash('status', 'Usuario actualizado correctamente');

        return redirect(route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Davidcb\Users\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        return $user->delete() ? 'ok' : 'error';
    }
}
