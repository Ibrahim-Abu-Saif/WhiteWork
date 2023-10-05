<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->res(ProjectResource::collection(Project::all()),'All Projects');
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
        ]);

        $img_name=$request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('img'),$img_name);

        $data=$request->except('image');
        $data['image']=$img_name;
        $data['company_id']=6;

        $project=Project::create($data);

        return $this->res(new ProjectResource($project),$project->name.'Project','Project Add Successfully',201);



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project=Project::find($id);
        if(!$project){
            return response()->json([
                'message'=>'No Data Found'
            ],404);
        }
        return $this->res(new ProjectResource($project),$project->name.'Project');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function res($data,$message='',$code=200,$status=true){
        return [
            'status'=>$status,
            'message'=>$message,
            'data'=>$data,
        ];
    }
}
