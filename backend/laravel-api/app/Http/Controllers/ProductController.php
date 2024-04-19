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

    public function getProduct($id, Request $request){



        // if (!Auth::check()) {
        //     return response()->json(['error' => 'Unauthenticated'], 401);
        // }

        // $user = Auth::user();

        // $id = $request->user()->id;
       $product = Products::where('id', $request['id'])->first();

    if (!$product) {
        return response()->json(['error' => 'Product not found'], 404);
    }

    if ($request->user()->id != $product->user_id) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    return response()->json($product);

            
        }

    public function updateProduct($id, Request $request){

        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        $user = Auth::user();

        $product = Products::where('id', $id)->first();

        $product->name = $request->name;
        $product->qty = $request->qty;
        $product->price = $request->price;
        $product->description = $request->description;
        $product['user_id'] = $request->user()->id;
        $product->save();
        return response()->json([
            'message' => 'Contact Updated Succesfully',
            'code'=> 200
        ]);
    }

    public function deleteProduct($id,Request $request){

        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        $user = Auth::user();
        $product = Products::find($id);
        $product['user_id'] = $request->user()->id;
        
        if($product){
            $product->delete();
            return response()->json([
                'message'=> 'Contact Deleted Succesfully',
                'code'=> 200
            ]);
        }else{
            return response()->json([
                'message'=> "Contact with id:$id does not exist",
            ]);
        }
    }

}
