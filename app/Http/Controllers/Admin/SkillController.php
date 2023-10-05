<?php

namespace App\Http\Controllers\Admin;

use App\Models\skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class skillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('all_skills');
        $skills=skill::latest('id')->paginate(10);
        return view('admin.skill.index',compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('crate_skill');
        return view('admin.skill.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $data=$request->except('_token');

        skill::create($data);

        return redirect()
        ->route('admin.skills.index')
        ->with('msg','skill Add Successfully')
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
        Gate::authorize('edit_skill');
        $skill=skill::findOrFail($id);
        // dd($skill);
        return view('admin.skill.edit',compact('skill'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, skill $skill)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $data=$request->except('_token');

        $skill->update($data);

        return redirect()
        ->route('admin.skills.index')
        ->with('msg','skill Updated Successfully')
        ->with('type','success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Gate::authorize('delete_skill');
        $skill=skill::findOrFail($id);
        $skill->delete();


        return 'Done';

    }
}
