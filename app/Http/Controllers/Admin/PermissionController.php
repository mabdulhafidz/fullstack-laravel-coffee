<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // $this->authorize('list', Permission::class);

        $permissions = Permission::latest()->get();

        return view('admin.permission.index')
            ->with('permission', $permissions);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // $this->authorize('create', Permission::class);

        $roles = Role::all();
        return view('admin.permission.create')->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        $this->authorize('create', Permission::class);

        $data = $this->validate($request, [
            'name' => 'required|max:64',
            'roles' => 'array'
        ]);

        $permission = Permission::create($data);

        $roles = Role::find($request->roles);
        $permission->syncRoles($roles);

        return redirect()
            ->route('permission.index', $permission->id)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission): View
    {
        $this->authorize('update', $permission);

        $roles = Role::get();

        return view('admin.permission.edit')
            ->with('permission', $permission)
            ->with('roles', $roles);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission): RedirectResponse
    {
        $this->authorize('update', $permission);

        $data = $this->validate($request, [
            'name' => 'required|max:40',
            'roles' => 'array'
        ]);

        $permission->update($data);

        $roles = Role::find($request->roles);
        $permission->syncRoles($roles);

        return redirect()
            ->route('permission.index', $permission->id)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission): RedirectResponse
    {
        $this->authorize('delete', $permission);

        $permission->delete();

        return redirect()
            ->route('permission.index')
            ->withSuccess(__('crud.common.removed'));
    }
}