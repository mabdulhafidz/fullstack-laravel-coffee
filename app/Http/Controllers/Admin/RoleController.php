<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = User::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = User::all();
        return view('admin.roles.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles|max:255',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        User::create($request->all());
        return redirect()->route('admin.roles.index')->with('success', 'Role created Good.'); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $role)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:roles,name,' . $role->id,
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $role->update($request->all());
        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($role, $user)
    {
        $user->delete();
        $role->user()->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
    }
}
