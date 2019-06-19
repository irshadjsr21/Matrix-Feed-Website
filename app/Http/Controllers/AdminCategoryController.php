<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_admin');
    }

    public function listCategory()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.category.index')->with('categories', $categories);
    }

    public function showCategory(Request $request, $id)
    {
        $category = Category::find($id);
        return view('admin.category.show')->with('category', $category);
    }

    public function editCategoryPage(Request $request, $id)
    {
        $category = Category::find($id);
        return view('admin.category.edit')->with('category', $category);
    }

    public function editCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $category = Category::find($id);

        $category->name = $request->input('name');

        $category->save();

        $request->session()->flash('success', 'Category updated successfully!');

        return redirect('/admin/category');
    }

    public function addCategoryPage()
    {
        return view('admin.category.add');
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        $category = new Category;
        $category->name = $request->input('name');
        $category->save();

        $request->session()->flash('success', 'Category added successfully!');

        return redirect('/admin/category');
    }

    public function deleteCategory(Request $request, $id)
    {
        $category = Category::find($id);

        $category->delete();
        $request->session()->flash('success', 'Category deleted successfully!');
        return redirect('/admin/category');
    }
}
