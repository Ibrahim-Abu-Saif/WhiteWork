<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects=Project::with('skills','category','payment')->where('company_id',Auth::id())
        ->latest('id')->paginate(5);
        $categories=Category::select('id','name')->get();
        $skills=Skill::select('id','name')->get();
        return view('company.project.index',compact('projects','categories','skills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::select('id','name')->get();
        $skills=Skill::select('id','name')->get();
        return view('company.project.create',compact('categories','skills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'name'=>'required',
            'image'=>'required',
            'price'=>'required',
            'content'=>'required',
            'duration'=>'required',
            'category_id'=>'required',
            'skills'=>'required',
        ]);

        $img_name=$request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('img'),$img_name);

        $data=$request->except('_token','image','skills');
        $data['image']=$img_name;
        $data['company_id']=Auth::id();

        $project=Project::create($data);

        $project->skills()->sync($request->skills);

        $projects=Project::with('skills','category')->where('company_id',Auth::id())
        ->latest('id')->paginate(5);
        if($request->has('fromIndex')){
         return view('company.project._table',compact('projects'))->render() ;
        }


        return redirect()
        ->route('company.projects.index')
        ->with('msg','Project Add Successfully')
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
    public function edit(Project $project)
    {

        $categories=Category::select('id','name')->get();
        $skills=Skill::select('id','name')->get();
        return view('company.project.edit',compact('categories','skills','project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([

            'name'=>'required',
            'price'=>'required',
            'content'=>'required',
            'duration'=>'required',
            'category_id'=>'required',
            'skills'=>'required',
        ]);

        $data=$request->except('_token','image','skills');
        if($request->hasFile('image')){
            File::delete(public_path('img/'.$project->image));
            $img_name=$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img'),$img_name);
            $data['image']=$img_name;
        }






        $project->update($data);
        $project->skills()->sync($request->skills);


        return redirect()
        ->route('company.projects.index')
        ->with('msg','Project Edit Successfully')
        ->with('type','success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        File::delete(public_path('img/'.$project->image));
        $project->delete();

        return'Done';



    }

    function edit_status($id){
        $project=Project::findOrFail($id);
        $project->update(['status'=> !$project->status]);
        return $project->status;
    }
}
