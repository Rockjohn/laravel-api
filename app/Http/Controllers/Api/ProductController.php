<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;  

//- Product controller includes all available API methods (except index), including validation (rules can be in a separate file too)
class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::find($id);
        
        if ($product) {
            return response()->json(['message' => 'Product found', 'data' => $product]);
        }

        return response()->json(['error' => 'Product '.$id.' not found'], 404);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:products',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|between:0.1,10000',
        ]);

        $product = Product::create($validatedData);

        return response()->json(['message' => 'Product added successfully', 'data' => $product], 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if ($product) {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255|unique:products,name,'.$product->id,
                'description' => 'required|string|max:1000',
                'price' => 'required|numeric|between:0.1,10000',
            ]);
    
            $product->update($validatedData);
    
            return response()->json(['message' => 'Product '.$id.' updated successfully']);
        } 

        return response()->json(['error' => 'Product '.$id.' not found'], 404);        
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
            return response()->json(['message' => 'Product '.$id.' deleted successfully']);
        }

        return response()->json(['error' => 'Product '.$id.' not found'], 404);
    }

}