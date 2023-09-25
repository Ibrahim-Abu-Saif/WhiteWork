<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::latest('id')->paginate(10);
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
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

        Category::create($data);

        return redirect()
        ->route('admin.Category.index')
        ->with('msg','Category Add Successfully')
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
        $category=Category::findOrFail($id);
        // dd($category);
        return view('admin.category.edit',compact('category'));

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
        $category=Category::findOrFail($id);

        $category->update($data);

        return redirect()
        ->route('admin.Category.index')
        ->with('msg','Category Updated Successfully')
        ->with('type','success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category=Category::findOrFail($id);
        $category->delete();


        return 'Done';

    }
}
