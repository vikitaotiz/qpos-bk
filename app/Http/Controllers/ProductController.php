<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::all();
        return response()->json(['products' => $products]);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'pname' => 'required|string|max:255',
            'categoryid' => 'required|integer',
            'barcode' => 'required|numeric|digits_between:1,20',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
        // // Create a new product record in the database
        // $product = new Product();
        // $product->pname = $request->input('pname');
        // $product->categoryid = $request->input('categoryid');
        // $product->save();
        $product = Product::create($request->all());
        return response()->json(['product' => $product], 201);
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->first();
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json(['product' => $product]);
    }

    public function update(Request $request, $id)
{
    $product = Product::where('id', $id)->first();
    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }
    // Validate the incoming request data
    $request->validate([
        'pname' => 'required|string|max:255',
        'categoryid' => 'required|integer',
        'barcode' => 'required|numeric|digits_between:1,20',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
    ]);
    $product->update($request->all());
    return response()->json(['product' => $product]);
}

    public function destroy($id)
{
    $product = Product::where('id', $id)->first();
    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }
    $product->delete();
    return response()->json(['message' => 'Product deleted successfully']);
}
}
