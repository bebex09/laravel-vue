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
         $products = Products::where('user_id', $userId)
                   ->orderBy('created_at', 'desc')
                   ->paginate(5);
        return response()->json($products);
    }

    public function getProduct($id){
        $product = Products::find($id);
        return response()->json($product);
    }

}
