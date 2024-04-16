<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

public function store(Request $request)
{
    // Ensure the request is authenticated
    if (!Auth::check()) {
        return response()->json(['error' => 'Unauthenticated'], 401);
    }

    // Retrieve the authenticated user
    $user = Auth::user();

    // Create a new product
    $data = $request->validate([
        'name' => 'required',
        'qty' => 'required|numeric',
        'price' => 'required|decimal:0,2',
        'description' => 'required',
    ]);

    $data['user_id'] = $request->user()->id;
    $newProduct = Products::create($data);

    var_dump($data['user_id']);

    // // Return a response
    // return response()->json([
    //     'message' => 'Product created successfully',
    //     'product' => $product, // Optionally, you can return the created product
    // ], 201);
}

}
