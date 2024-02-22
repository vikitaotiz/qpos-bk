<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        // Retrieve all categories from the database
        $categories = Category::all();
        return response()->json(['categories' => $categories]);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'cname' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        // // Create a new category record in the database
        // $category = new Category();
        // $category->cname = $request->input('cname');
        // $category->save();
 $category = Category::create($request->all());
        return response()->json(['category' => $category], 201);
    }

    public function show($id)
    {
        $category = Category::where('id', $id)->first();
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        return response()->json(['category' => $category]);
    }

    public function update(Request $request, $id)
{
    $category = Category::where('id', $id)->first();
    if (!$category) {
        return response()->json(['message' => 'Category not found'], 404);
    }
    // Validate the incoming request data
    $request->validate([
        'cname' => 'required|string|max:255',
        'description' => 'nullable|string',
        // Add validation rules for other fields
    ]);
    // Update the category with the new data
    $category->update($request->all());

    return response()->json(['category' => $category]);
}

    public function destroy($id)
{
    $category = Category::where('id', $id)->first();
    if (!$category) {
        return response()->json(['message' => 'Category not found'], 404);
    }
    $category->delete();
    return response()->json(['message' => 'Category deleted successfully']);
}
}
