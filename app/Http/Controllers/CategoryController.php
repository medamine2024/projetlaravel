<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index')->with('categories', $categories);
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

        if ($category->save()) {
            return redirect()->back()->with('success', 'Category created successfully');
        } else {
            return redirect()->back()->with('error', 'Category could not be created');
        }
    }

    public function update(Request $request)
{
    $id = $request->id_category; // Ensure this is the ID of the category being updated

    $request->validate([
        'name' => 'required|string|max:255|unique:categories,name,' . $id,
        'description' => 'required|string|max:255',
    ]);

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
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            try {
                $category->delete();
                return redirect()->back()->with('success', 'Category deleted successfully');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Category could not be deleted');
            }
        } else {
            return redirect()->back()->with('error', 'Category not found');
        }
    }
}
