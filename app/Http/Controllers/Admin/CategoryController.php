<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function view(){
        $categories = Category::all();

        return view('admin.category.create')->with([
            'categories' => $categories
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category_lower_case = strtolower($request->name);
        $name_taken = Category::where('name', $category_lower_case)->first();
        if ($name_taken) {
            return back()->with('status', 'Category name exists already');
        }

        $category = Category::create([
            'name' => $category_lower_case
        ]);

        return back();
    }

    public function viewEditCategoryForm($id){
        $category = Category::find($id);
        if (!$category) {
            return back();
        }

        $categories = Category::all();

        return view('admin.category.edit')->with([
            'category' => $category,
            'categories' => $categories
        ]);
    }

    public function update(Request $request){
        $request->validate([
            'category_id' => 'required|integer',
            'name' => 'required|string'
        ]);

        $user = auth()->user();

        $category_lower_case = strtolower($request->name);
        $category_name_exists = Category::where('name', $category_lower_case)->where('id', '!=', $request->category_id)->first();
        if ($category_name_exists) {
            return back()->with('status', 'Category name exists already');
        }

        $category = Category::find($request->category_id);

        $updated = $category->update([
            'name' => $category_lower_case
        ]);

        return redirect()->route('categories.view');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('categories.view');
    }
}
