<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('all_categories');
        $roles=Role::latest('id')->paginate(10);
        return view('admin.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('crate_category');
        $permissions=Permission::all();
        return view('admin.role.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $data=$request->except('_token','permissions');

        $role=Role::create($data);
        $role->permissions()->sync($request->permissions);

        return redirect()
        ->route('admin.roles.index')
        ->with('msg','Role Add Successfully')
        ->with('type','success');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        Gate::authorize('edit_category');
        $role=Role::findOrFail($id);
        // dd($role);
        return view('admin.role.edit',compact('role'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $data=$request->except('_token');
        $role=Role::findOrFail($id);

        $role->update($data);

        return redirect()
        ->route('admin.roles.index')
        ->with('msg','Role Updated Successfully')
        ->with('type','success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Gate::authorize('delete_category');
        $role=Role::findOrFail($id);
        $role->delete();


        return 'Done';

    }
}
