<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
      return view('admin.categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'required|string|max:255',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        if($category->save()){
        return redirect()->back()->with('success', 'Category created successfully');
    }
    else{
        return redirect()->back()->with('error', 'Category could not be created');
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $request->id_category,
            'description' => 'required|string|max:255',
        ]);
    
        $id = $request->id_category;
        $category = Category::find($id);
        if ($category) {
            $category->name = $request->name;
            $category->description = $request->description;
            if ($category->save()) {
                return redirect()->back()->with('success', 'Category updated successfully');
            } else {
                return redirect()->back()->with('error', 'Category could not be updated');
            }
        } else {
            return redirect()->back()->with('error', 'Category not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            if ($category->delete()) {
                return redirect()->back()->with('success', 'Category deleted successfully');
            } else {
                return redirect()->back()->with('error', 'Category could not be deleted');
            }
        } else {
            return redirect()->back()->with('error', 'Category not found');
        }
    }
}
