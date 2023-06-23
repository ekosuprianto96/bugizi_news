<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ACategoryController extends Controller
{
    // public function show()
    // {
    //     return view('admin.category.new-category', [
    //         'title' => 'New Category'
    //     ]);
    // }
    public function list_category()
    {
        $categorys = Category::latest()->get();
        return view('admin.category.list-category', [
            'title' => 'List Of Category',
            'categorys' => $categorys
        ]);
    }
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'color' => 'required'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->color = $request->color;
        $category->save();

        return redirect()->back();
    }
    public function delete($slug)
    {
        $category = Category::where('slug', $slug)->get()->first();
        $category->delete();

        return redirect()->back();
    }
    public function getCategory($slug)
    {
        $category = Category::where('slug', $slug)->get()->first();
        if ($category == null || empty($category)) {
            return response()->json([
                'message' => 'Error'
            ], 400);
        }
        return response()->json([
            'message' => 'success',
            'category' => $category
        ], 200);
    }
    public function update(Request $request)
    {
        $category = Category::where('slug', $request->slug_category)->get()->first();
        $category->name = $request->name;
        $category->slug = $request->slug;
        if (isset($request->color)) {
            $category->color = $request->color;
        }
        $category->save();

        return redirect()->back();
    }
}
