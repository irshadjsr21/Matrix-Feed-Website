<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_author')->only('listCategory', 'showCategory');
        $this->middleware('is_admin')->except('listCategory', 'showCategory');
    }

    public function listCategory()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.category.index')->with('categories', $categories);
    }

    public function showCategory(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            abort(404);
        }

        $posts = Post::leftJoin('users', 'users.id', '=', 'posts.author_id')
            ->select(DB::raw('posts.*, users.firstName as author_firstName, users.lastName as author_lastName'))
            ->where('category_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        $data = array(
            'category' => $category,
            'posts' => $posts,
        );

        return view('admin.category.show')->with($data);
    }

    public function editCategoryPage(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            abort(404);
        }

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

        if (!$category) {
            abort(404);
        }

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

        if (!$category) {
            abort(404);
        }

        $category->delete();
        $request->session()->flash('success', 'Category deleted successfully!');
        return redirect('/admin/category');
    }
}
