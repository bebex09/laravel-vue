<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller{

    public function store(Request $request){
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $user = Auth::user();

        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|decimal:0,2',
            'description' => 'required',
        ]);

        $data['user_id'] = $request->user()->id;
        $newProduct = Products::create($data);
        
        return response()->json([
            'message' => 'Product created successfully'
        ], 201);
    }

    public function products(Request $request){
        $userId = $request->user()->id;
        $products = Products::where('user_id', $userId)->get();
        return response()->json($products);
    }

}
