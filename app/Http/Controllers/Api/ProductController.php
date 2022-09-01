<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class ProductController extends Controller
{
    


    public function addProduct(Request $request)
    {
        $request->validate([
            "product_title" => "required",
            "size" => "required",
            "color" => "required",
            "price" => "required",
            "quantity" => "required",
            "description" => "required"
        ]);


        $products = new Product();
        $products->user_id = auth()->user()->id;
        $products->product_title = $request->product_title;
        $products->size = $request->size;
        $products->color = $request->color;
        $products->price = $request->price;
        $products->quantity = $request->quantity;
        $products->description = $request->description;
        $products->save();



        return response()->json([
            "status" => true,
            "message" => "Product Insert Successfully!!"
        ]);

    }


    public function show(){


        $products = Product::all();

        return response()->json([

            "status" => true,
            "message" => "All Product Show Successfully!",
            "product" => $products
        ]);
    }

    public function userProduct(){
       $user_id = auth()->user()->id;

       $products = User::find($user_id)->products;
       return response()->json([

                "status" => true,
                "message" => "User Product Show Successfully!",
                "product" => $products
        ]);
    }

    public function singleProduct($id){


        if (Product::where('id',$id)->exists()) {
            $products = Product::find($id);

            return response()->json([

                "status" => true,
                "message" => "Single Product Show Successfully!",
                "product" => $products
            ]);
        }else {
            return response()->json([

                "status" => false,
                "message" => "Product does not exist."
            ]);
        }
        
    }

    public function update(Request $request, $product_id){

        $products = Product::find($product_id);


        $products->product_title = isset($request->product_title) ? $request->product_title : $products->product_title;
        $products->size = isset($request->size) ? $request->size : $products->size;
        $products->color = isset($request->color) ? $request->color : $products->color;
        $products->price = isset($request->price) ? $request->price : $products->price;
        $products->quantity = isset($request->quantity) ? $request->quantity : $products->quantity;
        $products->description = isset($request->description) ? $request->description : $products->description;
        $products->save();


        return response()->json([

            "status" => true,
            "message" => "Update Product Successfully!"
        ]);
    }


    public function delete($id)
    {
        if (Product::where('id',$id)->exists()) {
            $products = Product::find($id);
            $products->delete();

            return response()->json([

                "status" => true,
                "message" => "Deleted Product Successfully!",
    
            ]);
        }else {
            return response()->json([

                "status" => false,
                "message" => "Product does not exist."
            ]);
        }
    }
}
