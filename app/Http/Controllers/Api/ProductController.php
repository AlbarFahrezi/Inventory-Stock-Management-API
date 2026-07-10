<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with([
            'category',
            'supplier',
            'warehouse'
        ])->get();


        return response()->json([
            'data'=>$products
        ]);
    }



    public function store(Request $request)
    {

        $request->validate([

            'category_id'=>'required|exists:categories,id',
            'supplier_id'=>'required|exists:suppliers,id',
            'warehouse_id'=>'required|exists:warehouses,id',

            'name'=>'required|string',
            'sku'=>'required|string|unique:products,sku',

            'price'=>'required|numeric',

            'description'=>'nullable|string'

        ]);


        $product = Product::create([

            'category_id'=>$request->category_id,
            'supplier_id'=>$request->supplier_id,
            'warehouse_id'=>$request->warehouse_id,

            'name'=>$request->name,
            'sku'=>$request->sku,

            'price'=>$request->price,

            // stock selalu 0
            'stock'=>0,

            'description'=>$request->description

        ]);


        return response()->json([

            'message'=>'Product created successfully',

            'data'=>$product

        ],201);

    }




    public function show(Product $product)
    {

        return response()->json([

            'data'=>$product->load([
                'category',
                'supplier',
                'warehouse'
            ])

        ]);

    }




    public function update(Request $request, Product $product)
    {

        $product->update([

            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description

        ]);


        return response()->json([

            'message'=>'Product updated successfully',

            'data'=>$product

        ]);

    }





    public function destroy(Product $product)
    {

        $product->delete();


        return response()->json([

            'message'=>'Product deleted successfully'

        ]);

    }

}