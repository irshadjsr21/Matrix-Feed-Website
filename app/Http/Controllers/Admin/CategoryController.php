<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
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
        $posts = $category->posts;
        $data = array(
            'category' => $category,
            'posts' => $posts,
        );

        return view('admin.category.show')->with($data);
    }

    public function editCategoryPage(Request $request, $id)
    {
        $category = Category::find($id);
        return view('admin.category.edit')->with('category', $category);
    }

    public function editCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z0-9_()*\-.!&@$\s]*$/|max:255',
        ]);

        $name = $request->input('name');

        $categories = Category::where([['name', $name], ['id', '!=', $id]])->count();
        if ($categories != 0) {
            $error = ValidationException::withMessages(['name' => 'Category with this name already exists.']);
            throw $error;
        }

        $category = Category::find($id);

        $category->name = $name;

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
            'name' => 'required|regex:/^[a-zA-Z0-9_()*\-.!&@$\s]*$/|unique:categories|max:255',
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
